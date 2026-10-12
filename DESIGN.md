# DESIGN.md - Auditify-IT Design Direction

Direction for Auditify-IT (COBIT 2019 IT Governance Audit Platform).
Crafted according to UI/UX Specifications and Stitch Project Guidelines.

## 1. Identity & Mood
- **Product**: Auditify-IT (Enterprise IT Governance & COBIT 2019 Assessment Platform)
- **Target Audience**: Chief Information Officers, IT Governance Auditors, University Reviewers
- **Tone**: Rigorous, trustworthy, clean enterprise, highly legible, data-dense without clutter
- **Design Dials**:
  - ENERGY: 2 (Professional corporate, clear hierarchy)
  - RHYTHM: 2 (Balanced layout, structured tables and split views)
  - MOTION: 1 (Subtle micro-interactions, accordion transitions, smooth slider feedback)

## 2. Color Palette & Semantics (WCAG AA Compliant)
- **Primary Brand**:
  - Light: `indigo-600` (`#4f46e5`)
  - Dark: `indigo-400` (`#818cf8`)
- **Neutrals**:
  - Light Background: `bg-slate-50` / `bg-white`
  - Dark Background: `bg-slate-950` / `bg-slate-900`
  - Border: `border-slate-200` (Dark: `border-slate-800`)
  - Text: `text-slate-900` / `text-slate-600` (Dark: `text-slate-100` / `text-slate-400`)
- **Audit Semantic Tokens (Always pair color with text/letter)**:
  - **Rating N (Not Achieved 0-15%) / Risk Tinggi**:
    - Light: `bg-red-100 text-red-800 border-red-200`
    - Dark: `bg-red-950 text-red-300 border-red-900`
  - **Rating P (Partially Achieved 15-50%) / Risk Sedang**:
    - Light: `bg-amber-100 text-amber-800 border-amber-200`
    - Dark: `bg-amber-950 text-amber-300 border-amber-900`
  - **Rating L (Largely Achieved 50-85%)**:
    - Light: `bg-sky-100 text-sky-800 border-sky-200`
    - Dark: `bg-sky-950 text-sky-300 border-sky-900`
  - **Rating F (Fully Achieved 85-100%) / Risk Rendah**:
    - Light: `bg-emerald-100 text-emerald-800 border-emerald-200`
    - Dark: `bg-emerald-950 text-emerald-300 border-emerald-900`
  - **Radar Series**:
    - Current Capability: `rgba(79, 70, 229, 1)` (fill `rgba(79, 70, 229, 0.2)`)
    - Target Capability: `rgba(100, 116, 139, 1)` dashed line

## 3. Typography & Spacing
- **Typography**: Inter / sans-serif, numbers always use `tabular-nums`
- **Border Radius**: `rounded-lg` (8px), buttons `rounded-md` (6px)
- **Spacing Grid**: 4px base (p-2, p-4, p-6, gap-4)
- **Layout Container**: Max-w-1440px for Dashboard/Report, Full-width for Split Assessment

## 4. Key Screens Overview
1. **Scope Diagnostic**:
   - 4 KPI cards (Terisi, Masuk Scope, Risiko Tinggi, Aktivitas).
   - Filter Domain (Semua, EDM, APO, BAI, DSS, MEA) & Search.
   - 40 rows table with Importance/Performance sliders (1-5) and real-time Risk Index badge.
   - Sticky Scope Summary with locking action.
2. **Side-by-Side Field Assessment**:
   - Split view: PDF SOP viewer on the left (zoom, paging, viewer controls).
   - Assessment questionnaire on the right (accordion per practice, N/P/L/F segmented toggle, finding notes textarea, evidence tag).
3. **Executive Gap Analysis & Reporting**:
   - Radar chart (0-5 scale, Current vs Target series).
   - Gap matrix table (positive gap = red badge, met/exceeded = green badge).
   - LHA PDF Export dialog.
