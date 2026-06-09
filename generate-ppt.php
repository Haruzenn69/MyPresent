<?php
/**
 * Generate PPTX Presentation with Laravel-style Theme (Teal #0D9488)
 * 
 * Usage: php generate-ppt.php
 * Output: present-presentation.pptx
 */

class PptxGenerator
{
    private string $output;
    private array $slides = [];
    private ZipArchive $zip;

    public function __construct(string $output = 'present-presentation.pptx')
    {
        $this->output = $output;
    }

    public function addSlide(string $title, string $content, string $style = 'default'): self
    {
        $this->slides[] = compact('title', 'content', 'style');
        return $this;
    }

    public function generate(): void
    {
        $this->zip = new ZipArchive;
        if ($this->zip->open($this->output, ZipArchive::CREATE) !== true) {
            throw new RuntimeException("Cannot create {$this->output}");
        }

        $count = count($this->slides);
        $this->addContentTypes($count);
        $this->addRels();
        $this->addPresentation($count);
        $this->addPresentationRels();
        $this->addTheme();
        $this->addSlideMaster();
        $this->addSlideMasterRels();
        $this->addSlideLayout();
        $this->addSlideLayoutRels();

        foreach ($this->slides as $i => $slide) {
            $num = $i + 1;
            $this->addSlideXml($num, $slide);
            $this->addSlideRels($num);
        }

        $this->addDocProps();

        $this->zip->close();
        echo "✅ Generated: {$this->output}\n";
    }

    private function addContentTypes(int $count): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Default Extension="png" ContentType="image/png"/>
  <Override PartName="/ppt/presentation.xml" ContentType="application/vnd.openxmlformats-officedocument.presentationml.presentation.main+xml"/>
  <Override PartName="/ppt/slideMasters/slideMaster1.xml" ContentType="application/vnd.openxmlformats-officedocument.presentationml.slideMaster+xml"/>
  <Override PartName="/ppt/slideLayouts/slideLayout1.xml" ContentType="application/vnd.openxmlformats-officedocument.presentationml.slideLayout+xml"/>
  <Override PartName="/ppt/theme/theme1.xml" ContentType="application/vnd.openxmlformats-officedocument.theme+xml"/>';
        for ($i = 1; $i <= $count; $i++) {
            $xml .= "\n  <Override PartName=\"/ppt/slides/slide{$i}.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.presentationml.slide+xml\"/>";
        }
        $xml .= "\n  <Override PartName=\"/docProps/core.xml\" ContentType=\"application/vnd.openxmlformats-package.core-properties+xml\"/>
  <Override PartName=\"/docProps/app.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.extended-properties+xml\"/>
</Types>";
        $this->zip->addFromString('[Content_Types].xml', $xml);
    }

    private function addRels(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="ppt/presentation.xml"/>
  <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>
  <Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/>
</Relationships>';
        $this->zip->addFromString('_rels/.rels', $xml);
    }

    private function addPresentation(int $count): void
    {
        $slideIds = '';
        for ($i = 1; $i <= $count; $i++) {
            $slideIds .= "\n    <sldId id=\"{$i}\" r:id=\"rId{$i}\"/>";
        }

        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:presentation xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
                xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main">
  <p:sldMasterIdLst>
    <p:sldMasterId id="2147483648" r:id="rIdMaster"/>
  </p:sldMasterIdLst>
  <p:sldIdLst>' . $slideIds . '
  </p:sldIdLst>
  <p:sldSz cx="12192000" cy="6858000"/>
  <p:notesSz cx="6858000" cy="9144000"/>
  <p:defaultTextStyle>
    <a:defPPr>
      <a:defRPr sz="1800" lang="en-US"/>
    </a:defPPr>
  </p:defaultTextStyle>
</p:presentation>';
        $this->zip->addFromString('ppt/presentation.xml', $xml);
    }

    private function addPresentationRels(): void
    {
        $count = count($this->slides);
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rIdMaster" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/slideMaster" Target="slideMasters/slideMaster1.xml"/>';
        for ($i = 1; $i <= $count; $i++) {
            $xml .= "\n  <Relationship Id=\"rId{$i}\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/slide\" Target=\"slides/slide{$i}.xml\"/>";
        }
        $xml .= "\n</Relationships>";
        $this->zip->addFromString('ppt/_rels/presentation.xml.rels', $xml);
    }

    private function addTheme(): void
    {
        // Teal #0D9488 Laravel-style theme
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<a:theme xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" name="Present Theme">
  <a:themeElements>
    <a:clrScheme name="Present">
      <a:dk1><a:srgbClr val="1E293B"/></a:dk1>
      <a:lt1><a:srgbClr val="F8FAFC"/></a:lt1>
      <a:dk2><a:srgbClr val="475569"/></a:dk2>
      <a:lt2><a:srgbClr val="F1F5F9"/></a:lt2>
      <a:accent1><a:srgbClr val="0D9488"/></a:accent1>
      <a:accent2><a:srgbClr val="0891B2"/></a:accent2>
      <a:accent3><a:srgbClr val="6366F1"/></a:accent3>
      <a:accent4><a:srgbClr val="F59E0B"/></a:accent4>
      <a:accent5><a:srgbClr val="10B981"/></a:accent5>
      <a:accent6><a:srgbClr val="EF4444"/></a:accent6>
      <a:hlink><a:srgbClr val="0D9488"/></a:hlink>
      <a:folHlink><a:srgbClr val="0F766E"/></a:folHlink>
    </a:clrScheme>
    <a:fontScheme name="Present">
      <a:majorFont>
        <a:latin typeface="Inter"/>
        <a:ea typeface=""/>
        <a:cs typeface=""/>
      </a:majorFont>
      <a:minorFont>
        <a:latin typeface="Inter"/>
        <a:ea typeface=""/>
        <a:cs typeface=""/>
      </a:minorFont>
    </a:fontScheme>
    <a:fmtScheme name="Present">
      <a:fillStyleLst>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
      </a:fillStyleLst>
      <a:lnStyleLst>
        <a:ln w="6350"><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:ln>
        <a:ln w="6350"><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:ln>
        <a:ln w="6350"><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:ln>
      </a:lnStyleLst>
      <a:effectStyleLst>
        <a:effectStyle><a:effectLst/></a:effectStyle>
        <a:effectStyle><a:effectLst/></a:effectStyle>
        <a:effectStyle><a:effectLst/></a:effectStyle>
      </a:effectStyleLst>
      <a:bgFillStyleLst>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
        <a:solidFill><a:schemeClr val="phClr"/></a:solidFill>
      </a:bgFillStyleLst>
    </a:fmtScheme>
  </a:themeElements>
</a:theme>';
        $this->zip->addFromString('ppt/theme/theme1.xml', $xml);
    }

    private function addSlideMaster(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:sldMaster xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
             xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
             xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main">
  <p:cSld>
    <p:spTree>
      <p:nvGrpSpPr>
        <p:cNvPr id="1" name=""/>
        <p:cNvGrpSpPr/>
        <p:nvPr/>
      </p:nvGrpSpPr>
      <p:grpSpPr/>
    </p:spTree>
  </p:cSld>
  <p:sldLayoutIdLst>
    <p:sldLayoutId id="2147483649" r:id="rIdLayout"/>
  </p:sldLayoutIdLst>
</p:sldMaster>';
        $this->zip->addFromString('ppt/slideMasters/slideMaster1.xml', $xml);
    }

    private function addSlideMasterRels(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rIdLayout" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/slideLayout" Target="../slideLayouts/slideLayout1.xml"/>
  <Relationship Id="rIdTheme" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/theme" Target="../theme/theme1.xml"/>
</Relationships>';
        $this->zip->addFromString('ppt/slideMasters/_rels/slideMaster1.xml.rels', $xml);
    }

    private function addSlideLayout(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:sldLayout xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
             xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
             xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main"
             type="blank">
  <p:cSld>
    <p:spTree>
      <p:nvGrpSpPr>
        <p:cNvPr id="1" name=""/>
        <p:cNvGrpSpPr/>
        <p:nvPr/>
      </p:nvGrpSpPr>
      <p:grpSpPr/>
    </p:spTree>
  </p:cSld>
</p:sldLayout>';
        $this->zip->addFromString('ppt/slideLayouts/slideLayout1.xml', $xml);
    }

    private function addSlideLayoutRels(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rIdTheme" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/theme" Target="../theme/theme1.xml"/>
</Relationships>';
        $this->zip->addFromString('ppt/slideLayouts/_rels/slideLayout1.xml.rels', $xml);
    }

    private function addSlideXml(int $num, array $slide): void
    {
        $title = htmlspecialchars($slide['title'], ENT_XML1);
        $lines = explode("\n", $slide['content']);
        $contentLines = array_map(fn($l) => htmlspecialchars($l, ENT_XML1), $lines);

        if ($slide['style'] === 'title') {
            $xml = $this->titleSlideXml($title, $contentLines[0] ?? '');
        } elseif ($slide['style'] === 'section') {
            $xml = $this->sectionSlideXml($title, $contentLines[0] ?? '');
        } else {
            $xml = $this->contentSlideXml($title, $contentLines);
        }

        $this->zip->addFromString("ppt/slides/slide{$num}.xml", $xml);
    }

    private function titleSlideXml(string $title, string $subtitle): string
    {
        $sub = htmlspecialchars($subtitle, ENT_XML1);
        [$yTitle, $ySub] = ['2500000', '3600000'];
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:sld xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
       xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
       xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main">
  <p:cSld>
    <p:spTree>
      <p:nvGrpSpPr>
        <p:cNvPr id="1" name=""/>
        <p:cNvGrpSpPr/>
        <p:nvPr/>
      </p:nvGrpSpPr>
      <p:grpSpPr/>
      <!-- Background: white surface -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="2" name="bg"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:solidFill><a:srgbClr val="F8FAFC"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Teal accent bar at top -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="3" name="accent"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="0" y="0"/><a:ext cx="12192000" cy="80000"/></a:xfrm>
          <a:solidFill><a:srgbClr val="0D9488"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Title -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="4" name="title"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="914400" y="' . $yTitle . '"/><a:ext cx="10363200" cy="900000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          <a:p>
            <a:r><a:rPr sz="4400" bold="1" dirty="0" spc="0"><a:solidFill><a:srgbClr val="0D9488"/></a:solidFill></a:rPr><a:t>' . $title . '</a:t></a:r>
          </a:p>
        </p:txBody>
      </p:sp>
      <!-- Subtitle -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="5" name="subtitle"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="914400" y="' . $ySub . '"/><a:ext cx="10363200" cy="600000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          <a:p>
            <a:r><a:rPr sz="2000" dirty="0" spc="0"><a:solidFill><a:srgbClr val="475569"/></a:solidFill></a:rPr><a:t>' . $sub . '</a:t></a:r>
          </a:p>
        </p:txBody>
      </p:sp>
    </p:spTree>
  </p:cSld>
</p:sld>';
    }

    private function sectionSlideXml(string $title, string $content): string
    {
        $escaped = htmlspecialchars($content, ENT_XML1);
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:sld xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
       xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
       xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main">
  <p:cSld>
    <p:spTree>
      <p:nvGrpSpPr>
        <p:cNvPr id="1" name=""/>
        <p:cNvGrpSpPr/>
        <p:nvPr/>
      </p:nvGrpSpPr>
      <p:grpSpPr/>
      <!-- Teal background -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="2" name="bg"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:solidFill><a:srgbClr val="0D9488"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Section Title -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="3" name="title"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="914400" y="2200000"/><a:ext cx="10363200" cy="1000000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          <a:p>
            <a:r><a:rPr sz="4800" bold="1" dirty="0" spc="0"><a:solidFill><a:srgbClr val="FFFFFF"/></a:solidFill></a:rPr><a:t>' . $title . '</a:t></a:r>
          </a:p>
        </p:txBody>
      </p:sp>
      <!-- Subtitle -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="4" name="subtitle"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="914400" y="3200000"/><a:ext cx="10363200" cy="600000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          <a:p>
            <a:r><a:rPr sz="2000" dirty="0" spc="0"><a:solidFill><a:srgbClr val="CCFBF1"/></a:solidFill></a:rPr><a:t>' . $escaped . '</a:t></a:r>
          </a:p>
        </p:txBody>
      </p:sp>
    </p:spTree>
  </p:cSld>
</p:sld>';
    }

    private function contentSlideXml(string $title, array $contentLines): string
    {
        $contentXml = '';
        foreach ($contentLines as $i => $line) {
            if ($i > 0) {
                $contentXml .= "\n            <a:p><a:r><a:rPr sz=\"1800\" dirty=\"0\" spc=\"0\"><a:solidFill><a:srgbClr val=\"1E293B\"/></a:solidFill></a:rPr><a:t>{$line}</a:t></a:r></a:p>";
            } else {
                $contentXml .= "\n            <a:p><a:r><a:rPr sz=\"1800\" dirty=\"0\" spc=\"0\"><a:solidFill><a:srgbClr val=\"1E293B\"/></a:solidFill></a:rPr><a:t>{$line}</a:t></a:r></a:p>";
            }
        }
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<p:sld xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"
       xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
       xmlns:p="http://schemas.openxmlformats.org/presentationml/2006/main">
  <p:cSld>
    <p:spTree>
      <p:nvGrpSpPr>
        <p:cNvPr id="1" name=""/>
        <p:cNvGrpSpPr/>
        <p:nvPr/>
      </p:nvGrpSpPr>
      <p:grpSpPr/>
      <!-- Background -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="2" name="bg"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:solidFill><a:srgbClr val="F8FAFC"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Teal top accent -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="3" name="accent"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="0" y="0"/><a:ext cx="12192000" cy="60000"/></a:xfrm>
          <a:solidFill><a:srgbClr val="0D9488"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Teal left accent bar -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="4" name="left-accent"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="0" y="0"/><a:ext cx="60000" cy="6858000"/></a:xfrm>
          <a:solidFill><a:srgbClr val="0D9488"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Title -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="5" name="title"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="685800" y="200000"/><a:ext cx="10800000" cy="600000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          <a:p>
            <a:r><a:rPr sz="3200" bold="1" dirty="0" spc="0"><a:solidFill><a:srgbClr val="0D9488"/></a:solidFill></a:rPr><a:t>' . $title . '</a:t></a:r>
          </a:p>
        </p:txBody>
      </p:sp>
      <!-- Separator line -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="6" name="separator"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="685800" y="850000"/><a:ext cx="10800000" cy="40000"/></a:xfrm>
          <a:solidFill><a:srgbClr val="CCFBF1"/></a:solidFill>
        </p:spPr>
        <p:txBody><a:bodyPr/><a:p/><a:endParaRPr lang="en-US"/></p:txBody>
      </p:sp>
      <!-- Content -->
      <p:sp>
        <p:nvSpPr><p:cNvPr id="7" name="content"/><p:nvSpPr/></p:nvSpPr>
        <p:spPr>
          <a:xfrm><a:off x="685800" y="1000000"/><a:ext cx="10800000" cy="5400000"/></a:xfrm>
        </p:spPr>
        <p:txBody>
          <a:bodyPr wrap="square" rtlCol="0"/>
          ' . $contentXml . '
        </p:txBody>
      </p:sp>
    </p:spTree>
  </p:cSld>
</p:sld>';
    }

    private function addSlideRels(int $num): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rIdLayout" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/slideLayout" Target="../slideLayouts/slideLayout1.xml"/>
</Relationships>';
        $this->zip->addFromString("ppt/slides/_rels/slide{$num}.xml.rels", $xml);
    }

    private function addDocProps(): void
    {
        $core = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties"
                   xmlns:dc="http://purl.org/dc/elements/1.1/"
                   xmlns:dcterms="http://purl.org/dc/terms/"
                   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <dc:title>Present - Sistem Absensi Digital</dc:title>
  <dc:subject>Presentasi Sistem Absensi</dc:subject>
  <dc:creator>Present Team</dc:creator>
  <cp:lastModifiedBy>Present</cp:lastModifiedBy>
  <dcterms:created xsi:type="dcterms:W3CDTF">' . date('Y-m-d\TH:i:s\Z') . '</dcterms:created>
  <dcterms:modified xsi:type="dcterms:W3CDTF">' . date('Y-m-d\TH:i:s\Z') . '</dcterms:modified>
</cp:coreProperties>';
        $this->zip->addFromString('docProps/core.xml', $core);

        $app = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties"
            xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes">
  <Application>Present</Application>
  <PresentationFormat>Widescreen</PresentationFormat>
  <SlideCount>' . count($this->slides) . '</SlideCount>
</Properties>';
        $this->zip->addFromString('docProps/app.xml', $app);
    }
}

// ─── Build Presentation ──────────────────────────────────────────────────────

$ppt = new PptxGenerator('present-presentation.pptx');

$ppt
    ->addSlide(
        'Present',
        'Sistem Absensi Digital\nModern, Efisien, Terpercaya',
        'title'
    )
    ->addSlide(
        'Agenda',
        "• Latar Belakang\n• Fitur Utama\n• Arsitektur Sistem\n• Demo Aplikasi\n• Tanya Jawab",
        'default'
    )
    ->addSlide(
        'Latar Belakang',
        "• Pencatatan kehadiran manual masih rentan kesalahan\n• Data absensi tidak terpusat dan sulit dilacak\n• Kebutuhan monitoring real-time kehadiran siswa & guru\n• Efisiensi waktu dan tenaga dalam rekap data",
        'default'
    )
    ->addSlide(
        'Sekilas Present',
        'Platform digital untuk mencatat, memantau, dan melaporkan kehadiran siswa & guru secara real-time.',
        'section'
    )
    ->addSlide(
        'Fitur Utama',
        "📱  Absensi Real-Time — Catat kehadiran langsung dari perangkat\n🎯  QR Code — Scan QR untuk absensi cepat & akurat\n📊  Dashboard Admin — Pantau seluruh data dalam satu layar\n📈  Rekap Otomatis — Laporan kehadiran siap cetak\n🔔  Peringatan Dini — Notifikasi batas alfa & keterlambatan\n🔐  Multi-Role — Admin, Guru, dan Siswa dalam satu sistem",
        'default'
    )
    ->addSlide(
        'Tanya Jawab',
        'Ada pertanyaan?\nSilakan diskusikan bersama tim Present.',
        'section'
    );

$ppt->generate();
