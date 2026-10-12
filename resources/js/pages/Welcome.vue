<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { Head, Link } from '@inertiajs/vue3'

onMounted(() => {
  document.documentElement.classList.remove('dark')
})
import {
  ShieldCheck,
  Lock,
  FileCheck,
  Calculator,
  Layers,
  Scale,
  Users,
  Info,
  CheckCircle2,
  FileText,
  BarChart3,
  SlidersHorizontal,
  Menu,
  X,
  ExternalLink,
  ChevronRight,
  BookmarkCheck,
  Server,
  ArrowRight,
  Activity,
  AlertCircle,
} from '@lucide/vue'
import { dashboard, login } from '@/routes'

// Import Shadcn / Reka UI Components
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter,
} from '@/components/ui/card'
import {
  Table,
  TableHeader,
  TableBody,
  TableRow,
  TableHead,
  TableCell,
  TableCaption,
} from '@/components/ui/table'
import {
  Tabs,
  TabsList,
  TabsTrigger,
  TabsContent,
} from '@/components/ui/tabs'
import {
  Accordion,
  AccordionItem,
  AccordionTrigger,
  AccordionContent,
} from '@/components/ui/accordion'
import {
  Alert,
  AlertTitle,
  AlertDescription,
} from '@/components/ui/alert'
import { Progress } from '@/components/ui/progress'
import { Slider } from '@/components/ui/slider'
import { Switch } from '@/components/ui/switch'
import { Separator } from '@/components/ui/separator'

// State Menu Navigasi Mobile
const isMobileNavOpen = ref(false)

// State Simulator Interaktif Diagnosa Scope
const simImportance = ref<number[]>([4])
const simPerformance = ref<number[]>([4])
const strictThreshold = ref<boolean>(false)

const activeThreshold = computed(() => (strictThreshold.value ? 12 : 15))
const computedRiskIndex = computed(() => {
  const imp = simImportance.value[0] ?? 1
  const perf = simPerformance.value[0] ?? 1
  return imp * perf
})
const isScopeSelected = computed(() => computedRiskIndex.value >= activeThreshold.value)

// Sampel Objective Scope Diagnostic
const sampleObjectives = [
  {
    code: 'APO12',
    name: 'Managed Risk',
    domain: 'APO',
    importance: 4,
    performance: 5,
    risk: 20,
    inScope: true,
  },
  {
    code: 'DSS05',
    name: 'Managed Security Services',
    domain: 'DSS',
    importance: 5,
    performance: 3,
    risk: 15,
    inScope: true,
  },
  {
    code: 'BAI06',
    name: 'Managed IT Changes',
    domain: 'BAI',
    importance: 4,
    performance: 3,
    risk: 12,
    inScope: false,
  },
  {
    code: 'EDM03',
    name: 'Ensured Risk Optimization',
    domain: 'EDM',
    importance: 2,
    performance: 1,
    risk: 2,
    inScope: false,
  },
]

// Data Domain COBIT 2019
const cobitDomains = [
  {
    code: 'EDM',
    name: 'Evaluate, Direct and Monitor',
    type: 'Governance',
    count: 5,
    description: 'Menetapkan arah tata kelola organisasi, mengevaluasi kebutuhan pemangku kepentingan, dan memantau kepatuhan.',
    examples: ['EDM01 Tata Kelola Terintegrasi', 'EDM02 Realisasi Nilai Investasi IT', 'EDM03 Optimasi Risiko IT'],
  },
  {
    code: 'APO',
    name: 'Align, Plan and Organize',
    type: 'Management',
    count: 14,
    description: 'Menyelaraskan strategi IT dengan sasaran bisnis, manajemen arsitektur, portofolio, dan manajemen risiko teknologi.',
    examples: ['APO12 Manajemen Risiko IT', 'APO13 Manajemen Keamanan Informasi', 'APO01 Kerangka Kerja Tata Kelola'],
  },
  {
    code: 'BAI',
    name: 'Build, Acquire and Implement',
    type: 'Management',
    count: 11,
    description: 'Pengadaan solusi, pembangunan sistem informasi, manajemen perubahan (change management), dan transisi layanan.',
    examples: ['BAI06 Manajemen Perubahan IT', 'BAI03 Definisi Solusi & Arsitektur', 'BAI10 Manajemen Konfigurasi'],
  },
  {
    code: 'DSS',
    name: 'Deliver, Service and Support',
    type: 'Management',
    count: 6,
    description: 'Operasional harian, layanan dukungan pengguna, kesinambungan bisnis, dan keamanan layanan operasional IT.',
    examples: ['DSS05 Layanan Keamanan IT', 'DSS01 Manajemen Operasi Layanan', 'DSS02 Manajemen Insiden & Permintaan'],
  },
  {
    code: 'MEA',
    name: 'Monitor, Evaluate and Assess',
    type: 'Management',
    count: 4,
    description: 'Pemantauan berkala terhadap kinerja sistem kontrol internal, kepatuhan regulasi eksternal, dan efektivitas audit.',
    examples: ['MEA01 Pemantauan Kinerja & Kepatuhan', 'MEA02 Evaluasi Sistem Pengendalian Internal', 'MEA03 Kepatuhan Regulasi Eksternal'],
  },
]

// Navigasi Link
const navLinks = [
  { label: 'Diagnosa Scope', href: '#diagnosa-scope' },
  { label: 'Simulator Risiko', href: '#simulator-scope' },
  { label: '4 Fase Audit', href: '#fase-audit' },
  { label: 'Master Domain', href: '#domain-cobit' },
  { label: 'Hak Akses', href: '#hak-akses' },
  { label: 'Metodologi & FAQ', href: '#metodologi' },
]
</script>

<template>
  <Head title="Auditify-IT | Platform Audit Tata Kelola COBIT 2019" />

  <div class="min-h-screen bg-white text-slate-900 antialiased flex flex-col justify-between selection:bg-indigo-600 selection:text-white">
    <!-- Navbar Lengkap & Responsif Sesuai Foto -->
    <header class="border-b border-slate-200 bg-white sticky top-0 z-50 shadow-2xs">
      <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <!-- Brand Identity -->
        <div class="flex items-center gap-3">
          <a href="#" class="flex items-center gap-2.5 focus:outline-none">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-xs">
              <ShieldCheck class="h-5 w-5" />
            </div>
            <div>
              <div class="flex items-center gap-2">
                <span class="text-base font-bold tracking-tight text-slate-900">Auditify-IT</span>
                <span class="rounded-full border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-700">
                  COBIT 2019
                </span>
              </div>
              <p class="text-[10px] text-slate-500 font-medium leading-none mt-0.5">Sistem Audit Tata Kelola IT</p>
            </div>
          </a>
        </div>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
          <a
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="px-2.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-md transition-colors"
          >
            {{ link.label }}
          </a>
        </nav>

        <!-- Action Buttons (Desktop) Sesuai Foto -->
        <div class="hidden sm:flex items-center gap-2.5">
          <a href="#simulator-scope">
            <Button variant="soft" class="h-9 px-3.5 border border-indigo-200 hover:border-indigo-300 text-xs font-semibold rounded-lg shadow-2xs transition-all cursor-pointer">
              <Calculator class="mr-1.5 h-3.5 w-3.5 text-indigo-600" />
              Coba Simulator
            </Button>
          </a>

          <Link v-if="$page.props.auth.user" :href="dashboard()">
            <Button class="h-9 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Buka Dashboard
            </Button>
          </Link>
          <template v-else>
            <Link :href="login()">
              <Button class="h-9 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-xs transition-colors">
                <Lock class="mr-1.5 h-3.5 w-3.5" />
                Masuk ke Sistem
              </Button>
            </Link>
          </template>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <div class="flex items-center lg:hidden">
          <Button
            variant="outline"
            size="sm"
            class="h-9 w-9 p-0 border-slate-300 text-slate-700"
            @click="isMobileNavOpen = !isMobileNavOpen"
            :aria-expanded="isMobileNavOpen"
            aria-label="Buka Menu Navigasi"
          >
            <X v-if="isMobileNavOpen" class="h-4 w-4" />
            <Menu v-else class="h-4 w-4" />
          </Button>
        </div>
      </div>

      <!-- Mobile Navigation Drawer -->
      <div
        v-if="isMobileNavOpen"
        class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-5 space-y-3 shadow-lg"
      >
        <div class="grid grid-cols-1 gap-1">
          <a
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="px-3 py-2 text-sm font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 rounded-md transition-colors"
            @click="isMobileNavOpen = false"
          >
            {{ link.label }}
          </a>
        </div>

        <Separator class="bg-slate-200 my-2" />

        <div class="flex flex-col gap-2 pt-1">
          <a href="#simulator-scope" @click="isMobileNavOpen = false">
            <Button variant="soft" class="w-full h-10 border border-indigo-200 font-semibold text-xs">
              <Calculator class="mr-1.5 h-3.5 w-3.5 text-indigo-600" />
              Coba Simulator Risiko
            </Button>
          </a>

          <Link v-if="$page.props.auth.user" :href="dashboard()">
            <Button class="w-full h-10 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs">
              Buka Dashboard
            </Button>
          </Link>
          <Link v-else :href="login()">
            <Button class="w-full h-10 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs">
              <Lock class="mr-1.5 h-3.5 w-3.5" />
              Masuk ke Sistem
            </Button>
          </Link>
        </div>
      </div>
    </header>

    <main class="flex-1 space-y-12 sm:space-y-16 pb-12">
      <!-- Hero Section Sesuai Foto -->
      <section id="diagnosa-scope" class="pt-10 pb-8 sm:pt-14 sm:pb-12 bg-white border-b border-slate-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
            <!-- Kolom Kiri: Deskripsi & Navigasi -->
            <div class="lg:col-span-6 space-y-5">
              <div class="flex flex-wrap gap-2">
                <span class="rounded-full border border-indigo-200 bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-700">
                  Standar ISO/IEC 33020
                </span>
                <span class="rounded-full border border-slate-200 bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                  40 Master Objectives
                </span>
                <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                  Akses Auditor Otoritatif
                </span>
              </div>

              <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                Audit Tata Kelola IT Berbasis COBIT 2019 <span class="text-indigo-600">Tanpa Kesalahan Rumus Manual.</span>
              </h1>

              <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                Auditify-IT menyatukan seluruh tahapan audit tata kelola IT ke dalam satu meja kerja digital: penyaringan scope otomatis dengan Risk Index, pengujian kesesuaian SOP per aktivitas, hingga kalkulasi Capability Level dan Analisis Gap yang otoritatif.
              </p>

              <div class="pt-2 flex flex-col sm:flex-row gap-3">
                <Link v-if="$page.props.auth.user" :href="dashboard()" class="w-full sm:w-auto">
                  <Button size="lg" class="w-full h-11 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg text-sm shadow-xs transition-colors">
                    Masuk ke Dashboard Proyek
                  </Button>
                </Link>
                <Link v-else :href="login()" class="w-full sm:w-auto">
                  <Button size="lg" class="w-full h-11 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg text-sm shadow-xs transition-colors">
                    Masuk ke Akun Auditor
                  </Button>
                </Link>

                <a href="#simulator-scope" class="w-full sm:w-auto">
                  <Button variant="soft" size="lg" class="w-full h-11 px-5 border-2 border-indigo-200 hover:border-indigo-300 font-semibold text-sm transition-all">
                    <SlidersHorizontal class="mr-2 h-4 w-4 text-indigo-600" />
                    Eksplorasi Simulator
                  </Button>
                </a>
              </div>

              <!-- Baris Metrik Standar Sesuai Foto -->
              <div class="pt-6 border-t border-slate-200 grid grid-cols-3 gap-4">
                <div>
                  <div class="text-2xl font-extrabold tabular-nums text-slate-900">40</div>
                  <div class="text-xs text-slate-500 mt-0.5">Objective COBIT</div>
                </div>
                <div>
                  <div class="text-2xl font-extrabold text-slate-900">N, P, L, F</div>
                  <div class="text-xs text-slate-500 mt-0.5">Skala ISO/IEC 33020</div>
                </div>
                <div>
                  <div class="text-2xl font-extrabold tabular-nums text-slate-900">0 s.d. 5</div>
                  <div class="text-xs text-slate-500 mt-0.5">Tingkat Kapabilitas</div>
                </div>
              </div>
            </div>

            <!-- Kolom Kanan: Pratinjau Meja Kerja dengan Card & Table UI Sesuai Foto -->
            <div class="lg:col-span-6">
              <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                <!-- Header Card -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                  <div class="flex items-start gap-2">
                    <div class="h-2 w-2 rounded-full bg-indigo-600 mt-1.5 shrink-0"></div>
                    <div>
                      <h2 class="text-sm font-bold text-slate-900">
                        Pratinjau Meja Kerja Diagnosa Scope
                      </h2>
                      <p class="text-[11px] text-slate-500 mt-0.5">
                        Kalkulasi Risk Index otomatis: Importance x Performance
                      </p>
                    </div>
                  </div>
                  <span class="rounded-md border border-red-200 bg-red-50 px-2 py-0.5 font-mono text-xs font-bold text-red-600">
                    Ambang Batas &ge; 15
                  </span>
                </div>

                <!-- UI Component Table Sesuai Foto -->
                <div class="overflow-x-auto rounded-lg border border-slate-200">
                  <table class="w-full text-left text-xs bg-white">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                      <tr>
                        <th class="py-2.5 px-3">OBJECTIVE</th>
                        <th class="py-2.5 px-2 text-center">IMP.</th>
                        <th class="py-2.5 px-2 text-center">PERF.</th>
                        <th class="py-2.5 px-2 text-center">RISK INDEX</th>
                        <th class="py-2.5 px-3 text-right">KEPUTUSAN SCOPE</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                      <tr v-for="obj in sampleObjectives" :key="obj.code" class="hover:bg-slate-50/70 transition-colors">
                        <td class="py-2.5 px-3 font-medium">
                          <span class="font-mono text-indigo-700 font-bold mr-1.5">{{ obj.code }}</span>
                          <span class="text-slate-900">{{ obj.name }}</span>
                        </td>
                        <td class="py-2.5 px-2 text-center tabular-nums font-mono">{{ obj.importance }}</td>
                        <td class="py-2.5 px-2 text-center tabular-nums font-mono">{{ obj.performance }}</td>
                        <td class="py-2.5 px-2 text-center font-mono">
                          <span :class="obj.risk >= 15 ? 'text-red-600 font-extrabold' : 'text-slate-800 font-semibold'">
                            {{ obj.risk }}
                          </span>
                        </td>
                        <td class="py-2.5 px-3 text-right">
                          <span
                            v-if="obj.inScope"
                            class="inline-block rounded-md border border-red-200 bg-red-50 px-2 py-0.5 text-[11px] font-semibold text-red-600"
                          >
                            Masuk Scope
                          </span>
                          <span
                            v-else
                            class="inline-block rounded-md border border-slate-200 bg-slate-50 px-2 py-0.5 text-[11px] font-medium text-slate-600"
                          >
                            Di Luar Scope
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- Keterangan Catatan Bawah -->
                <div class="flex items-center gap-2 text-[11px] text-slate-600 pt-1">
                  <div class="h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></div>
                  <span>Objective dengan Risk Index &ge; 15 otomatis direkomendasikan masuk ke lembar uji lapangan.</span>
                </div>

                <!-- Footer Card -->
                <div class="pt-3 border-t border-slate-200 flex items-center justify-between text-xs text-slate-600">
                  <span class="flex items-center gap-1.5 font-medium text-emerald-700">
                    <CheckCircle2 class="h-3.5 w-3.5 text-emerald-600" />
                    Kalkulasi server terverifikasi
                  </span>
                  <span class="font-semibold text-slate-700">Target Level Standar: 3</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Simulator Interaktif Penentuan Scope Sesuai Foto -->
      <section id="simulator-scope" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 scroll-mt-20">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs space-y-6">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
            <div>
              <span class="rounded-full border border-indigo-200 bg-indigo-50 px-2.5 py-0.5 text-[11px] font-semibold text-indigo-700 mb-1 inline-block">
                Kalkulator Interaktif
              </span>
              <h2 class="text-base sm:text-lg font-bold text-slate-900">
                Simulator Interaktif Formula Penentuan Scope
              </h2>
              <p class="text-xs text-slate-500 mt-0.5">
                Uji langsung kalkulasi Risk Index (Importance x Performance) dan amati perubahan status rekomendasi scope secara instan.
              </p>
            </div>

            <!-- Switch UI Komponen -->
            <div class="flex items-center gap-2.5 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200 self-start sm:self-auto">
              <label for="strict-threshold-mode" class="text-xs font-semibold text-slate-700 cursor-pointer select-none">
                Mode Ambang Ketat (&ge; 12)
              </label>
              <Switch
                id="strict-threshold-mode"
                :model-value="strictThreshold"
                @update:model-value="strictThreshold = $event"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Slider Input Controls -->
            <div class="lg:col-span-7 space-y-6">
              <!-- Slider Importance -->
              <div>
                <div class="flex justify-between items-center mb-1">
                  <label class="text-xs font-bold text-slate-900">
                    Tingkat Kepentingan (Importance):
                    <span class="text-indigo-600 font-bold ml-1 font-mono">{{ simImportance[0] }} / 5</span>
                  </label>
                  <span class="text-[11px] text-slate-500">Skala 1 (Rendah) s.d. 5 (Kritis)</span>
                </div>
                <Slider
                  :model-value="simImportance"
                  :min="1"
                  :max="5"
                  :step="1"
                  class="py-2"
                  @update:model-value="val => simImportance = val || [1]"
                />
                <!-- Label Skala Bawah Sesuai Foto -->
                <div class="flex justify-between text-[11px] font-semibold text-slate-600 px-1 mt-0.5">
                  <span>1: Sangat Rendah</span>
                  <span>2</span>
                  <span>3: Sedang</span>
                  <span>4</span>
                  <span>5: Sangat Kritis</span>
                </div>
              </div>

              <!-- Slider Performance -->
              <div>
                <div class="flex justify-between items-center mb-1">
                  <label class="text-xs font-bold text-slate-900">
                    Kesenjangan Kinerja (Performance Gap):
                    <span class="text-indigo-600 font-bold ml-1 font-mono">{{ simPerformance[0] }} / 5</span>
                  </label>
                  <span class="text-[11px] text-slate-500">Skala 1 (Sempurna) s.d. 5 (Bermasalah)</span>
                </div>
                <Slider
                  :model-value="simPerformance"
                  :min="1"
                  :max="5"
                  :step="1"
                  class="py-2"
                  @update:model-value="val => simPerformance = val || [1]"
                />
                <!-- Label Skala Bawah Sesuai Foto -->
                <div class="flex justify-between text-[11px] font-semibold text-slate-600 px-1 mt-0.5">
                  <span>1: Tidak Ada Celah</span>
                  <span>2</span>
                  <span>3: Cukup Bermasalah</span>
                  <span>4</span>
                  <span>5: Kritis Total</span>
                </div>
              </div>

              <!-- Progress Bar Nilai Relatif Sesuai Foto -->
              <div>
                <div class="flex justify-between items-center text-xs mb-1.5 font-medium text-slate-700">
                  <span>Persentase Risiko Relatif Terhadap Skala Maksimum (25):</span>
                  <span class="font-mono font-bold text-slate-900">{{ Math.round((computedRiskIndex / 25) * 100) }}%</span>
                </div>
                <Progress :model-value="(computedRiskIndex / 25) * 100" class="h-2.5 bg-slate-100" />
              </div>
            </div>

            <!-- Box Hasil Kalkulasi Sesuai Foto -->
            <div class="lg:col-span-5">
              <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-5 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                  <span class="text-xs font-bold uppercase tracking-wider text-slate-600">HASIL KALKULASI RISK INDEX</span>
                  <span class="rounded bg-white border border-slate-200 px-2 py-0.5 font-mono text-xs font-semibold text-slate-700">
                    Ambang Batas: &ge; {{ activeThreshold }}
                  </span>
                </div>

                <div class="flex items-baseline justify-between">
                  <div>
                    <div class="text-4xl font-extrabold font-mono text-red-600 tabular-nums">
                      {{ computedRiskIndex }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 font-mono">
                      Formula: {{ simImportance[0] }} &times; {{ simPerformance[0] }} | Skala Maksimal = 25
                    </div>
                  </div>
                </div>

                <div>
                  <span
                    v-if="isScopeSelected"
                    class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-100/70 px-3 py-1 text-xs font-bold text-red-700"
                  >
                    <CheckCircle2 class="h-3.5 w-3.5" />
                    REKOMENDASI: MASUK SCOPE
                  </span>
                  <span
                    v-else
                    class="inline-flex items-center gap-1.5 rounded-md border border-slate-300 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700"
                  >
                    DI LUAR SCOPE AUDIT
                  </span>
                </div>

                <p class="text-xs text-slate-600 leading-relaxed pt-2 border-t border-slate-200">
                  {{ isScopeSelected
                    ? 'Objective ini memiliki indikasi risiko tinggi. Sistem akan menyertakan seluruh aktivitas prosesnya ke lembar uji lapangan Fase 2.'
                    : 'Objective ini berada di bawah ambang batas risiko. Auditor dapat tetap memasukkannya melalui fasilitas manual override dengan mencantumkan alasan tertulis.'
                  }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Siklus 4 Fase Audit: Card UI Grid Sesuai Foto -->
      <section id="fase-audit" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 scroll-mt-20">
        <div class="text-center max-w-2xl mx-auto mb-10">
          <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
            Siklus 4 Fase Audit Tata Kelola IT
          </h2>
          <p class="mt-2 text-xs sm:text-sm text-slate-600">
            Seluruh data tercatat rapi dan berurutan dari penentuan scope awal hingga penerbitan dokumen laporan akhir.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Card Fase 1 -->
          <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-2xs hover:border-slate-300 transition-colors flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="rounded border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[11px] font-bold font-mono text-indigo-700">
                  FASE 1
                </span>
                <span class="text-xs text-slate-400 font-medium">Inisiasi</span>
              </div>
              <h3 class="text-sm font-bold text-slate-900">
                Diagnosa & Scope
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Penilaian 40 objective pada matriks Importance dan Performance (1-5). Sistem merekomendasikan scope audit secara otomatis berdasarkan ambang risiko, dilengkapi fasilitas override manual beralasan.
              </p>
            </div>
            <a href="#diagnosa-scope" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 pt-2 border-t border-slate-100">
              <span>Menuju Diagnosa Scope</span>
              <ChevronRight class="h-3 w-3" />
            </a>
          </div>

          <!-- Card Fase 2 -->
          <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-2xs hover:border-slate-300 transition-colors flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="rounded border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[11px] font-bold font-mono text-indigo-700">
                  FASE 2
                </span>
                <span class="text-xs text-slate-400 font-medium">Uji Lapangan</span>
              </div>
              <h3 class="text-sm font-bold text-slate-900">
                Field Assessment & SOP
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Penilaian aktivitas proses terpilih dengan skala N, P, L, F. Panel kiri menampilkan dokumen SOP PDF dan panel kanan kuesioner aktivitas dengan catatan temuan wajib saat rating N atau P.
              </p>
            </div>
            <a href="#fase-audit" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 pt-2 border-t border-slate-100">
              <span>Aplikasi Bukti SOP</span>
              <ChevronRight class="h-3 w-3" />
            </a>
          </div>

          <!-- Card Fase 3 -->
          <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-2xs hover:border-slate-300 transition-colors flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="rounded border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[11px] font-bold font-mono text-indigo-700">
                  FASE 3
                </span>
                <span class="text-xs text-slate-400 font-medium">Kalkulasi</span>
              </div>
              <h3 class="text-sm font-bold text-slate-900">
                Capability & Gap Engine
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Engine menghitung Capability Level (0-5) per objective dan selisihnya terhadap target (Gap). Visualisasi Radar Chart memetakan kondisi saat ini terhadap target organisasi.
              </p>
            </div>
            <a href="#fase-audit" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 pt-2 border-t border-slate-100">
              <span>Perhitungan Level 0-5</span>
              <ChevronRight class="h-3 w-3" />
            </a>
          </div>

          <!-- Card Fase 4 -->
          <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-2xs hover:border-slate-300 transition-colors flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="rounded border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[11px] font-bold font-mono text-indigo-700">
                  FASE 4
                </span>
                <span class="text-xs text-slate-400 font-medium">Pelaporan</span>
              </div>
              <h3 class="text-sm font-bold text-slate-900">
                LHA PDF & Komparasi
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Penerbitan Laporan Hasil Audit (LHA) format PDF resmi, pengarsipan proyek, serta perbandingan peningkatan kapabilitas dengan periode audit sebelumnya.
              </p>
            </div>
            <a href="#fase-audit" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 pt-2 border-t border-slate-100">
              <span>Dokumen Audit Resmi</span>
              <ChevronRight class="h-3 w-3" />
            </a>
          </div>
        </div>
      </section>

      <!-- Eksplorasi Master Domain COBIT 2019 Sesuai Foto -->
      <section id="domain-cobit" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 scroll-mt-20">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs space-y-5">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
            <div>
              <h2 class="text-base sm:text-lg font-bold text-slate-900">
                Eksplorasi Master Domain COBIT 2019
              </h2>
              <p class="text-xs text-slate-500 mt-0.5">
                40 Master Objectives terbagi dalam 5 domain tata kelola dan manajemen teknologi informasi.
              </p>
            </div>
            <span class="rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-700 self-start sm:self-auto">
              Total 40 Objectives
            </span>
          </div>

          <!-- Tabs Domain Sesuai Foto -->
          <Tabs default-value="EDM" class="w-full">
            <TabsList class="grid grid-cols-5 w-full max-w-md bg-slate-100 p-1 rounded-lg">
              <TabsTrigger
                v-for="dom in cobitDomains"
                :key="dom.code"
                :value="dom.code"
                class="text-xs font-semibold py-1.5 data-[state=active]:bg-indigo-600 data-[state=active]:text-white rounded-md transition-colors"
              >
                {{ dom.code }} ({{ dom.count }})
              </TabsTrigger>
            </TabsList>

            <div class="mt-5">
              <TabsContent
                v-for="dom in cobitDomains"
                :key="dom.code"
                :value="dom.code"
                class="focus-visible:outline-none"
              >
                <div class="rounded-lg border border-slate-200 bg-slate-50/60 p-5 space-y-4">
                  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                      <span class="font-mono text-sm font-bold text-white bg-indigo-600 px-2.5 py-1 rounded">
                        {{ dom.code }}
                      </span>
                      <div>
                        <h3 class="text-sm font-bold text-slate-900">{{ dom.name }}</h3>
                        <span class="text-xs text-slate-500 font-medium">Klasifikasi: {{ dom.type }}</span>
                      </div>
                    </div>
                    <span class="rounded border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                      {{ dom.count }} Standar Objectives
                    </span>
                  </div>

                  <p class="text-xs text-slate-700 leading-relaxed">
                    {{ dom.description }}
                  </p>

                  <Separator class="bg-slate-200" />

                  <div>
                    <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-600 mb-2">CONTOH OBJECTIVE TERKAIT:</h4>
                    <div class="flex flex-wrap gap-2">
                      <span
                        v-for="example in dom.examples"
                        :key="example"
                        class="rounded-md border border-slate-200 bg-white px-2.5 py-1 text-xs font-medium text-slate-700 shadow-2xs"
                      >
                        {{ example }}
                      </span>
                    </div>
                  </div>
                </div>
              </TabsContent>
            </div>
          </Tabs>
        </div>
      </section>

      <!-- Hak Akses Peran Pengguna & Metodologi FAQ Sesuai Foto -->
      <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          <!-- Hak Akses 3 Peran: Card UI Sesuai Foto -->
          <div id="hak-akses" class="lg:col-span-6 space-y-4 scroll-mt-20">
            <div>
              <h2 class="text-lg font-bold text-slate-900">
                Pemisahan Peran & Tanggung Jawab
              </h2>
              <p class="text-xs text-slate-500 mt-0.5">
                Tiga peran independen untuk menegakkan integritas dan kepatuhan standar audit.
              </p>
            </div>

            <div class="space-y-3">
              <!-- Role 1: Auditor -->
              <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-2xs space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2.5">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                      <Users class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-900">Auditor Utama</span>
                  </div>
                  <span class="rounded-full border border-indigo-200 bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-700">
                    Akses Penuh
                  </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed pl-9">
                  Bertanggung jawab menentukan scope diagnosa, menilai aktivitas proses dengan skala N/P/L/F, mencatat temuan gap, serta menerbitkan Laporan Hasil Audit resmi.
                </p>
              </div>

              <!-- Role 2: Auditee -->
              <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-2xs space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2.5">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                      <FileText class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-900">Pimpinan IT / Auditee</span>
                  </div>
                  <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700">
                    Unggah Bukti & Pantau
                  </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed pl-9">
                  Menyediakan dan mengunggah dokumen bukti SOP format PDF untuk diverifikasi pada lembar kerja, serta memantau progres pelaksanaan audit.
                </p>
              </div>

              <!-- Role 3: Reviewer -->
              <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-2xs space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2.5">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                      <Scale class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-900">Dosen Penguji / Reviewer</span>
                  </div>
                  <span class="rounded-full border border-slate-200 bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-700">
                    Hanya Baca (Read-only)
                  </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed pl-9">
                  Dapat meninjau seluruh lembar kerja, mengecek kesesuaian bukti dokumen terhadap penilaian aktivitas, serta memverifikasi kalkulasi kapabilitas.
                </p>
              </div>
            </div>
          </div>

          <!-- Metodologi & Pertanyaan Standar: Accordion UI Component Sesuai Foto -->
          <div id="metodologi" class="lg:col-span-6 space-y-4 scroll-mt-20">
            <div>
              <h2 class="text-lg font-bold text-slate-900">
                Dasar Metodologi & Standar Perhitungan
              </h2>
              <p class="text-xs text-slate-500 mt-0.5">
                Kepatuhan matematis terhadap kerangka kerja COBIT 2019 dan ISO/IEC 33020.
              </p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-2xs">
              <Accordion type="single" collapsible class="w-full">
                <AccordionItem value="faq-1" class="border-b border-slate-100">
                  <AccordionTrigger class="text-xs font-semibold text-slate-900 hover:no-underline hover:text-indigo-600 py-3">
                    Bagaimana skala penilaian ISO/IEC 33020 dihitung?
                  </AccordionTrigger>
                  <AccordionContent class="text-xs text-slate-600 leading-relaxed pb-3">
                    Penilaian aktivitas proses menggunakan 4 tingkat pemenuhan:
                    <ul class="list-disc pl-4 mt-2 space-y-1 font-mono text-[11px]">
                      <li><strong>N (Not Achieved)</strong>: 0% s.d. 15% kesesuaian</li>
                      <li><strong>P (Partially Achieved)</strong>: &gt;15% s.d. 50% kesesuaian</li>
                      <li><strong>L (Largely Achieved)</strong>: &gt;50% s.d. 85% kesesuaian</li>
                      <li><strong>F (Fully Achieved)</strong>: &gt;85% s.d. 100% kesesuaian</li>
                    </ul>
                  </AccordionContent>
                </AccordionItem>

                <AccordionItem value="faq-2" class="border-b border-slate-100">
                  <AccordionTrigger class="text-xs font-semibold text-slate-900 hover:no-underline hover:text-indigo-600 py-3">
                    Kapan suatu level kapabilitas dinyatakan tercapai?
                  </AccordionTrigger>
                  <AccordionContent class="text-xs text-slate-600 leading-relaxed pb-3">
                    Sesuai aturan COBIT 2019, Capability Level $L$ dinyatakan tercapai jika seluruh aktivitas pada level tersebut memperoleh rating minimal <strong>Largely (L)</strong> atau <strong>Fully (F)</strong>, serta seluruh level di bawahnya ($L-1$) telah terpenuhi secara kumulatif.
                  </AccordionContent>
                </AccordionItem>

                <AccordionItem value="faq-3" class="border-b border-slate-100">
                  <AccordionTrigger class="text-xs font-semibold text-slate-900 hover:no-underline hover:text-indigo-600 py-3">
                    Apakah auditor dapat mengubah cakupan scope audit?
                  </AccordionTrigger>
                  <AccordionContent class="text-xs text-slate-600 leading-relaxed pb-3">
                    Ya. Sistem menyediakan fasilitas Manual Override pada lembar diagnosa scope. Setiap perubahan status yang berbeda dari rekomendasi otomatis sistem wajib menyertakan justifikasi tertulis yang tercatat permanen di activity log.
                  </AccordionContent>
                </AccordionItem>

                <AccordionItem value="faq-4" class="border-b-0">
                  <AccordionTrigger class="text-xs font-semibold text-slate-900 hover:no-underline hover:text-indigo-600 py-3">
                    Bagaimana keabsahan laporan hasil audit (LHA) dijamin?
                  </AccordionTrigger>
                  <AccordionContent class="text-xs text-slate-600 leading-relaxed pb-3">
                    LHA diterbitkan dalam format PDF terstandar lengkap dengan nomor proyek, tanggal verifikasi, matriks gap, rincian temuan aktivitas, dan catatan audit trail yang tidak dapat diubah setelah proyek berstatus Archived.
                  </AccordionContent>
                </AccordionItem>
              </Accordion>
            </div>

            <!-- Alert UI Sesuai Foto -->
            <div class="rounded-xl border border-indigo-200 bg-indigo-50/70 p-4 flex items-start gap-3">
              <Info class="h-4 w-4 text-indigo-700 shrink-0 mt-0.5" />
              <div>
                <h3 class="text-xs font-bold text-indigo-900 uppercase tracking-wide">JAMINAN INTEGRITAS PERHITUNGAN</h3>
                <p class="text-xs text-indigo-800/90 mt-0.5 leading-relaxed">
                  Kalkulasi Capability Result dan Scope Diagnostic dijalankan langsung pada backend service secara terpusat untuk mencegah deviasi rumus antar pengguna.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer Lengkap Sesuai Foto (Dark Navy / Black Background) -->
    <footer class="bg-slate-950 text-slate-400 text-xs">
      <!-- Bagian Atas Footer: 4 Kolom Informasi Sesuai Foto -->
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">
          <!-- Kolom 1: Identitas Platform & Misi (lg:col-span-4) -->
          <div class="lg:col-span-4 space-y-4">
            <div class="flex items-center gap-2.5">
              <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-xs">
                <ShieldCheck class="h-5 w-5" />
              </div>
              <div class="flex items-center gap-2">
                <span class="text-base font-bold tracking-tight text-white">Auditify-IT</span>
                <span class="rounded border border-indigo-500/40 bg-indigo-950 px-1.5 py-0.5 text-[10px] font-semibold text-indigo-300">
                  v1.0.0
                </span>
              </div>
            </div>

            <p class="text-xs text-slate-400 leading-relaxed">
              Platform komprehensif audit tata kelola teknologi informasi berbasis kerangka kerja ISACA COBIT 2019 dan standar asesmen proses ISO/IEC 33020, menggantikan lembar sebar manual demi integritas data dan kepatuhan yang akuntabel.
            </p>

            <div class="pt-2 space-y-2">
              <div class="flex items-center gap-2 text-xs text-slate-300">
                <CheckCircle2 class="h-4 w-4 text-emerald-400 shrink-0" />
                <span>Kalkulasi Kapabilitas & Gap Otoritatif</span>
              </div>
              <div class="flex items-center gap-2 text-xs text-slate-300">
                <CheckCircle2 class="h-4 w-4 text-emerald-400 shrink-0" />
                <span>Activity Log & Audit Trail Terlindungi</span>
              </div>
              <div class="flex items-center gap-2 text-xs text-slate-300">
                <CheckCircle2 class="h-4 w-4 text-emerald-400 shrink-0" />
                <span>Ekspor LHA Resmi Format PDF</span>
              </div>
            </div>
          </div>

          <!-- Kolom 2: Modul & Siklus Audit (lg:col-span-3) -->
          <div class="lg:col-span-3 space-y-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">
              MODUL & SIKLUS AUDIT
            </h3>
            <ul class="space-y-2 text-xs text-slate-400">
              <li>
                <a href="#diagnosa-scope" class="hover:text-white transition-colors">
                  Diagnosa Scope (Fase 1)
                </a>
              </li>
              <li>
                <a href="#simulator-scope" class="hover:text-white transition-colors">
                  Simulator Risk Index
                </a>
              </li>
              <li>
                <a href="#fase-audit" class="hover:text-white transition-colors">
                  Uji SOP Lapangan (Fase 2)
                </a>
              </li>
              <li>
                <a href="#fase-audit" class="hover:text-white transition-colors">
                  Engine Kapabilitas (Fase 3)
                </a>
              </li>
              <li>
                <a href="#fase-audit" class="hover:text-white transition-colors">
                  Penerbitan LHA PDF (Fase 4)
                </a>
              </li>
              <li>
                <a href="#hak-akses" class="hover:text-white transition-colors">
                  Pemisahan Hak Akses 3 Peran
                </a>
              </li>
            </ul>
          </div>

          <!-- Kolom 3: 5 Domain Master COBIT (lg:col-span-3) -->
          <div class="lg:col-span-3 space-y-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">
              DOMAIN COBIT
            </h3>
            <ul class="space-y-2 text-xs text-slate-400">
              <li>
                <a href="#domain-cobit" class="hover:text-white transition-colors">
                  EDM (Governance)
                </a>
              </li>
              <li>
                <a href="#domain-cobit" class="hover:text-white transition-colors">
                  APO (Management)
                </a>
              </li>
              <li>
                <a href="#domain-cobit" class="hover:text-white transition-colors">
                  BAI (Management)
                </a>
              </li>
              <li>
                <a href="#domain-cobit" class="hover:text-white transition-colors">
                  DSS (Management)
                </a>
              </li>
              <li>
                <a href="#domain-cobit" class="hover:text-white transition-colors">
                  MEA (Management)
                </a>
              </li>
            </ul>
          </div>

          <!-- Kolom 4: Kepatuhan Standar & Akses (lg:col-span-2) -->
          <div class="lg:col-span-2 space-y-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">
              STANDAR & REGULASI
            </h3>
            <ul class="space-y-2 text-xs text-slate-400">
              <li>
                <span class="block text-slate-400">Kerangka Kerja:</span>
                <span class="text-slate-200 font-semibold">ISACA COBIT 2019</span>
              </li>
              <li>
                <span class="block text-slate-400">Asesmen Proses:</span>
                <span class="text-slate-200 font-semibold">ISO/IEC 33020:2015</span>
              </li>
              <li>
                <span class="block text-slate-400">Zona Waktu Audit:</span>
                <span class="text-slate-200 font-semibold">Asia/Jakarta (WIB)</span>
              </li>
              <li class="pt-2">
                <Link :href="login()">
                  <Button variant="outline" size="sm" class="w-full h-9 text-xs font-semibold border-slate-700 bg-slate-900 text-slate-200 hover:bg-slate-800 hover:text-white">
                    <Lock class="mr-1.5 h-3.5 w-3.5" />
                    Portal Masuk Sistem
                  </Button>
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Bottom Bar Sesuai Foto -->
      <div class="border-t border-slate-800 bg-slate-950 py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <div>
            &copy; {{ new Date().getFullYear() }} Auditify-IT. Sistem Audit Tata Kelola IT. Seluruh hak cipta dilindungi.
          </div>

          <div class="flex items-center gap-4 text-xs">
            <span class="flex items-center gap-1.5 text-emerald-400 font-medium">
              <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
              Sistem 100% Terverifikasi
            </span>
            <span class="text-slate-700">|</span>
            <a href="#metodologi" class="text-slate-400 hover:text-white transition-colors">Metodologi Audit</a>
            <span class="text-slate-700">|</span>
            <a href="#domain-cobit" class="text-slate-400 hover:text-white transition-colors">Katalog COBIT</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
