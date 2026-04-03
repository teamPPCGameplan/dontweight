import { lazy, Suspense } from 'react'
import { Routes, Route, Navigate } from 'react-router-dom'
import { AuthProvider } from './hooks/useAuth'
import ErrorBoundary from './components/ErrorBoundary'
import ProtectedRoute from './components/ProtectedRoute'
import Layout from './components/Layout'
import LoadingSpinner from './components/LoadingSpinner'
import Login from './pages/Login'

// Lazy-load pages for better initial load performance
const Dashboard = lazy(() => import('./pages/Dashboard'))
const Weight = lazy(() => import('./pages/Weight'))
const Messages = lazy(() => import('./pages/Messages'))
const Subscription = lazy(() => import('./pages/Subscription'))
const Photos = lazy(() => import('./pages/Photos'))
const VideoCalls = lazy(() => import('./pages/VideoCalls'))
const HealthChecks = lazy(() => import('./pages/HealthChecks'))
const Settings = lazy(() => import('./pages/Settings'))
const AiAssistant = lazy(() => import('./pages/AiAssistant'))
const More = lazy(() => import('./pages/More'))
const Onboarding = lazy(() => import('./pages/Onboarding'))
const ClinicianDashboard = lazy(() => import('./pages/clinician/ClinicianDashboard'))
const PatientList = lazy(() => import('./pages/clinician/PatientList'))
const PatientDetail = lazy(() => import('./pages/clinician/PatientDetail'))
const ClinicianMessages = lazy(() => import('./pages/clinician/ClinicianMessages'))

function ProtectedPage({ children, clinician = false }) {
  return (
    <ProtectedRoute requireClinician={clinician}>
      <Layout>
        <Suspense fallback={<PageLoader />}>
          {children}
        </Suspense>
      </Layout>
    </ProtectedRoute>
  )
}

function PageLoader() {
  return (
    <div className="flex items-center justify-center py-20">
      <div className="flex flex-col items-center gap-3">
        <div className="w-8 h-8 border-2 border-stone border-t-gold rounded-full animate-spin" />
        <p className="text-sm text-slate">Loading...</p>
      </div>
    </div>
  )
}

function NotFound() {
  return (
    <div className="min-h-screen bg-cream flex items-center justify-center p-4">
      <div className="text-center animate-fade-in">
        <p className="text-6xl font-bold text-gold mb-4">404</p>
        <h1 className="text-xl font-bold text-ink mb-2">Page not found</h1>
        <p className="text-sm text-slate mb-6">The page you are looking for does not exist.</p>
        <a href="/dashboard" className="bg-gold text-dark font-semibold px-6 py-2.5 rounded-full hover:bg-gold-light transition-all hover:-translate-y-0.5 inline-block">
          Back to dashboard
        </a>
      </div>
    </div>
  )
}

export default function App() {
  return (
    <ErrorBoundary>
      <AuthProvider>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/onboarding" element={
            <Suspense fallback={<LoadingSpinner />}>
              <Onboarding />
            </Suspense>
          } />

          {/* Client routes */}
          <Route path="/dashboard" element={<ProtectedPage><Dashboard /></ProtectedPage>} />
          <Route path="/weight" element={<ProtectedPage><Weight /></ProtectedPage>} />
          <Route path="/messages" element={<ProtectedPage><Messages /></ProtectedPage>} />
          <Route path="/order" element={<ProtectedPage><Subscription /></ProtectedPage>} />
          <Route path="/subscription" element={<Navigate to="/order" replace />} />
          <Route path="/photos" element={<ProtectedPage><Photos /></ProtectedPage>} />
          <Route path="/video-calls" element={<ProtectedPage><VideoCalls /></ProtectedPage>} />
          <Route path="/health-checks" element={<ProtectedPage><HealthChecks /></ProtectedPage>} />
          <Route path="/settings" element={<ProtectedPage><Settings /></ProtectedPage>} />
          <Route path="/ai-assistant" element={<ProtectedPage><AiAssistant /></ProtectedPage>} />
          <Route path="/more" element={<ProtectedPage><More /></ProtectedPage>} />

          {/* Clinician routes */}
          <Route path="/clinician/dashboard" element={<ProtectedPage clinician><ClinicianDashboard /></ProtectedPage>} />
          <Route path="/clinician/patients" element={<ProtectedPage clinician><PatientList /></ProtectedPage>} />
          <Route path="/clinician/patients/:id" element={<ProtectedPage clinician><PatientDetail /></ProtectedPage>} />
          <Route path="/clinician/messages" element={<ProtectedPage clinician><ClinicianMessages /></ProtectedPage>} />

          {/* Redirects */}
          <Route path="/" element={<Navigate to="/dashboard" replace />} />
          <Route path="*" element={<NotFound />} />
        </Routes>
      </AuthProvider>
    </ErrorBoundary>
  )
}
