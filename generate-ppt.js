const PptxGenJS = require('pptxgenjs');

const pptx = new PptxGenJS();
pptx.defineLayout({ name: 'WIDE', width: 13.33, height: 7.5 });
pptx.layout = 'WIDE';
pptx.author = 'Present';
pptx.subject = 'Sistem Absensi Digital';
pptx.title = 'Present - Sistem Absensi Digital';

const teal = '0D9488';
const tealGlow = '14B8A6';
const tealDark = '0F766E';
const darkBg = '0F172A';
const darkCard = '1E293B';
const darkSurface = '1E293B';
const white = 'FFFFFF';
const muted = '94A3B8';
const accentPurple = '7C3AED';

// ─── Slide 1: Title ─────────────────────────────────────────────────────────

const s1 = pptx.addSlide();
s1.background = { fill: darkBg };
s1.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 7.5,
  fill: { type: 'solid', color: darkBg },
});
s1.addShape(pptx.ShapeType.ellipse, {
  x: -2, y: -2, w: 6, h: 6,
  fill: { type: 'solid', color: teal, transparency: 85 },
});
s1.addShape(pptx.ShapeType.ellipse, {
  x: 9, y: 4, w: 5, h: 5,
  fill: { type: 'solid', color: accentPurple, transparency: 85 },
});
s1.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 0.06,
  fill: { color: teal },
});
s1.addText('Present', {
  x: 1, y: 2.2, w: 11.33, h: 1.4,
  fontSize: 52, bold: true, color: white, fontFace: 'Inter',
  shadow: { type: 'outer', blur: 20, offset: 0, color: teal, opacity: 0.35 },
});
s1.addText('Sistem Absensi Digital', {
  x: 1, y: 3.6, w: 11.33, h: 0.6,
  fontSize: 22, color: tealGlow, fontFace: 'Inter',
});
s1.addText('Modern · Efisien · Terpercaya', {
  x: 1, y: 4.2, w: 11.33, h: 0.5,
  fontSize: 14, color: muted, fontFace: 'Inter',
});
s1.addShape(pptx.ShapeType.rect, {
  x: 1, y: 5.0, w: 2, h: 0.04,
  fill: { color: teal },
});

// ─── Slide 2: Agenda ────────────────────────────────────────────────────────

const s2 = pptx.addSlide();
s2.background = { fill: darkBg };
s2.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 7.5,
  fill: { type: 'solid', color: darkBg },
});
s2.addShape(pptx.ShapeType.ellipse, {
  x: 10, y: -1.5, w: 4, h: 4,
  fill: { type: 'solid', color: teal, transparency: 88 },
});
cardBase(s2, 'Agenda', [
  'Latar Belakang',
  'Fitur Utama',
  'Arsitektur Sistem',
  'Demo Aplikasi',
  'Tanya Jawab',
]);

// ─── Slide 3: Latar Belakang ────────────────────────────────────────────────

const s3 = pptx.addSlide();
s3.background = { fill: darkBg };
cardBase(s3, 'Latar Belakang', [
  'Pencatatan kehadiran manual masih rentan kesalahan',
  'Data absensi tidak terpusat dan sulit dilacak',
  'Kebutuhan monitoring real-time kehadiran siswa & guru',
  'Efisiensi waktu dan tenaga dalam rekap data',
]);

// ─── Slide 4: Sekilas Present ───────────────────────────────────────────────

const s4 = pptx.addSlide();
s4.background = { fill: darkBg };
s4.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 7.5,
  fill: {
    type: 'gradient',
    color: tealDark, transparency: 0,
    stops: [
      { position: 0, color: darkBg, transparency: 0 },
      { position: 40, color: tealDark, transparency: 0 },
      { position: 100, color: teal, transparency: 20 },
    ],
  },
});
// Decorative blobs
s4.addShape(pptx.ShapeType.ellipse, {
  x: -1, y: -1, w: 4, h: 4,
  fill: { type: 'solid', color: white, transparency: 92 },
});
s4.addShape(pptx.ShapeType.ellipse, {
  x: 9, y: 4, w: 5, h: 5,
  fill: { type: 'solid', color: accentPurple, transparency: 88 },
});
// Small accent line
s4.addShape(pptx.ShapeType.rect, {
  x: 1, y: 2.0, w: 1.5, h: 0.04,
  fill: { color: tealGlow },
});
s4.addText('Sekilas Present', {
  x: 1, y: 2.2, w: 11.33, h: 1.0,
  fontSize: 40, bold: true, color: white, fontFace: 'Inter',
});
s4.addText(
  'Platform digital untuk mencatat, memantau,\ndan melaporkan kehadiran siswa & guru secara real-time.',
  {
    x: 1, y: 3.3, w: 11.33, h: 0.9,
    fontSize: 18, color: muted, fontFace: 'Inter', lineSpacingMultiple: 1.5,
  }
);

// ─── Slide 5: Fitur Utama ───────────────────────────────────────────────────

const s5 = pptx.addSlide();
s5.background = { fill: darkBg };
s5.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 7.5,
  fill: { type: 'solid', color: darkBg },
});
// Title
s5.addText('Fitur Utama', {
  x: 0.8, y: 0.3, w: 11.73, h: 0.7,
  fontSize: 28, bold: true, color: white, fontFace: 'Inter',
});
s5.addShape(pptx.ShapeType.rect, {
  x: 0.8, y: 1.05, w: 2.5, h: 0.04,
  fill: { color: teal },
});

const features = [
  { icon: '📱', title: 'Absensi Real-Time', desc: 'Catat kehadiran langsung dari perangkat' },
  { icon: '🎯', title: 'QR Code', desc: 'Scan QR untuk absensi cepat & akurat' },
  { icon: '📊', title: 'Dashboard Admin', desc: 'Pantau seluruh data dalam satu layar' },
  { icon: '📈', title: 'Rekap Otomatis', desc: 'Laporan kehadiran siap cetak' },
  { icon: '🔔', title: 'Peringatan Dini', desc: 'Notifikasi batas alfa & keterlambatan' },
  { icon: '🔐', title: 'Multi-Role', desc: 'Admin, Guru, dan Siswa dalam satu sistem' },
];

features.forEach((f, i) => {
  const col = i % 3;
  const row = Math.floor(i / 3);
  const x = 0.8 + col * 4.0;
  const y = 1.5 + row * 2.7;

  s5.addShape(pptx.ShapeType.roundRect, {
    x, y, w: 3.6, h: 2.3,
    fill: { type: 'solid', color: darkCard },
    line: { color: darkSurface, width: 1 },
    rectRadius: 6,
    shadow: { type: 'outer', blur: 12, offset: 2, color: teal, opacity: 0.08 },
  });
  s5.addShape(pptx.ShapeType.rect, {
    x, y, w: 3.6, h: 0.04,
    fill: { color: teal },
  });
  s5.addText(f.icon, {
    x, y: y + 0.2, w: 3.6, h: 0.6,
    fontSize: 24, align: 'center', fontFace: 'Inter',
  });
  s5.addText(f.title, {
    x: x + 0.3, y: y + 0.85, w: 3.0, h: 0.5,
    fontSize: 15, bold: true, color: white, fontFace: 'Inter', align: 'center',
  });
  s5.addText(f.desc, {
    x: x + 0.3, y: y + 1.35, w: 3.0, h: 0.6,
    fontSize: 12, color: muted, fontFace: 'Inter', align: 'center',
  });
});

// ─── Slide 6: Tanya Jawab ───────────────────────────────────────────────────

const s6 = pptx.addSlide();
s6.background = { fill: darkBg };
s6.addShape(pptx.ShapeType.rect, {
  x: 0, y: 0, w: 13.33, h: 7.5,
  fill: {
    type: 'gradient',
    color: tealDark, transparency: 0,
    stops: [
      { position: 0, color: darkBg, transparency: 0 },
      { position: 50, color: tealDark, transparency: 10 },
      { position: 100, color: teal, transparency: 30 },
    ],
  },
});
s6.addShape(pptx.ShapeType.ellipse, {
  x: 4, y: -2, w: 8, h: 8,
  fill: { type: 'solid', color: teal, transparency: 88 },
});
s6.addShape(pptx.ShapeType.ellipse, {
  x: -1, y: 4, w: 4, h: 4,
  fill: { type: 'solid', color: accentPurple, transparency: 85 },
});
s6.addText('Tanya Jawab', {
  x: 1, y: 2.5, w: 11.33, h: 1.0,
  fontSize: 44, bold: true, color: white, fontFace: 'Inter',
  shadow: { type: 'outer', blur: 16, offset: 0, color: teal, opacity: 0.3 },
});
s6.addText('Ada pertanyaan?\nSilakan diskusikan bersama tim Present.', {
  x: 1, y: 3.6, w: 11.33, h: 0.8,
  fontSize: 18, color: muted, fontFace: 'Inter', lineSpacingMultiple: 1.5,
});
s6.addShape(pptx.ShapeType.rect, {
  x: 1, y: 4.7, w: 2, h: 0.04,
  fill: { color: tealGlow },
});

// ─── Save ───────────────────────────────────────────────────────────────────

const filename = 'present-presentation.pptx';
pptx.writeFile({ fileName: filename })
  .then(() => console.log('✅ Generated:', filename))
  .catch(err => console.error('❌ Error:', err));

// ─── Helpers ────────────────────────────────────────────────────────────────

function cardBase(slide, title, items) {
  slide.addShape(pptx.ShapeType.ellipse, {
    x: -1.5, y: 5, w: 5, h: 5,
    fill: { type: 'solid', color: teal, transparency: 90 },
  });
  slide.addText(title, {
    x: 1, y: 0.4, w: 11.33, h: 0.7,
    fontSize: 28, bold: true, color: white, fontFace: 'Inter',
  });
  slide.addShape(pptx.ShapeType.rect, {
    x: 1, y: 1.15, w: 2.5, h: 0.04,
    fill: { color: teal },
  });
  slide.addText(
    items.map((item, i) => ({
      text: `0${i + 1}`,
      options: { fontSize: 14, color: tealGlow, fontFace: 'Inter', bold: true },
    })),
    { x: 1.2, y: 1.6, w: 0.6, h: items.length * 0.9, lineSpacingMultiple: 1.8, valign: 'top' }
  );
  slide.addText(
    items.map(item => ({
      text: item,
      options: { fontSize: 17, color: muted, fontFace: 'Inter' },
    })),
    { x: 1.9, y: 1.6, w: 10, h: items.length * 0.9, lineSpacingMultiple: 1.8, valign: 'top' }
  );
  items.forEach((_, i) => {
    slide.addShape(pptx.ShapeType.rect, {
      x: 1.2, y: 2.45 + i * 0.9, w: 10.73, h: 0.01,
      fill: { color: teal, transparency: 85 },
    });
  });
}
