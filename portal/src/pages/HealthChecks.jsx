import { useState, useEffect } from 'react'
import { useAuth } from '../hooks/useAuth'
import { supabase } from '../lib/supabase'
import StatusBadge from '../components/StatusBadge'
import { CardSkeleton } from '../components/LoadingSpinner'
import { Shield, HeartPulse, Activity, Droplets, CheckCircle2, AlertTriangle, Stethoscope, FlaskConical, Building2 } from 'lucide-react'

export default function HealthChecks() {
  const { user } = useAuth()
  const [bookings, setBookings] = useState([])
  const [loading, setLoading] = useState(true)

  useEffect(() => { fetchBookings() }, [])

  async function fetchBookings() {
    setLoading(true)
    try {
      const { data, error } = await supabase
        .from('health_check_bookings')
        .select('*')
        .eq('user_id', user.id)
        .order('created_at', { ascending: false })
      if (error) throw error
      setBookings(data || [])
    } catch (err) {
      // Silently handle - user sees empty state
    }
    setLoading(false)
  }

  return (
    <div className="max-w-5xl mx-auto space-y-8 animate-fade-in">
      {/* Hero section */}
      <div className="bg-gradient-to-r from-gold/10 to-emerald-500/10 border border-gold/15 rounded-[16px] p-6 md:p-8">
        <h1 className="text-2xl font-bold text-ink tracking-tight">Comprehensive Health Checks</h1>
        <p className="text-sm text-slate mt-2 max-w-2xl leading-relaxed">
          Don't just lose weight — understand what's happening inside your body. Our health checks monitor 30-50+ biomarkers including liver function, kidney health, thyroid performance, cholesterol levels, and key cancer markers. Every result is personally reviewed by one of our clinicians with a detailed written report.
        </p>
        <div className="flex flex-wrap gap-4 mt-4">
          <div className="flex items-center gap-1.5 text-xs text-emerald-400 font-medium">
            <CheckCircle2 size={14} /> CQC-registered clinic
          </div>
          <div className="flex items-center gap-1.5 text-xs text-emerald-400 font-medium">
            <CheckCircle2 size={14} /> Results within 24 hours
          </div>
          <div className="flex items-center gap-1.5 text-xs text-emerald-400 font-medium">
            <CheckCircle2 size={14} /> Clinician-reviewed report
          </div>
          <div className="flex items-center gap-1.5 text-xs text-emerald-400 font-medium">
            <CheckCircle2 size={14} /> Accredited UK laboratories
          </div>
        </div>
      </div>

      {/* LPUG partnership banner */}
      <div className="bg-gradient-to-r from-sky-500/5 to-emerald-500/5 border border-sky-500/15 rounded-[16px] p-5 flex items-center gap-4">
        <div className="w-12 h-12 rounded-full bg-sky-500/10 border border-sky-500/20 flex items-center justify-center shrink-0">
          <Building2 size={20} className="text-sky-400" />
        </div>
        <div>
          <p className="text-sm font-semibold text-ink">
            Performed by <span className="text-sky-400">London Private Ultrasound Group</span>
          </p>
          <p className="text-xs text-slate mt-0.5 leading-relaxed">
            All health checks are delivered by London Private Ultrasound Group's experienced sonographers and clinical team using state-of-the-art diagnostic equipment at our London and St Albans clinics.
          </p>
        </div>
      </div>

      {/* Why health checks matter */}
      <div>
        <h2 className="text-lg font-bold text-ink mb-1">Why health checks matter on GLP-1 treatment</h2>
        <p className="text-sm text-slate mb-4 max-w-2xl leading-relaxed">
          GLP-1 medications like semaglutide and tirzepatide are powerful tools for weight loss, but they affect more than just your appetite. Regular blood work helps your clinician ensure the treatment is safe and effective for you.
        </p>
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          {[
            {
              icon: HeartPulse,
              title: 'Heart & liver safety',
              desc: 'GLP-1 treatments can influence liver enzymes, cholesterol, and cardiovascular markers. Monitoring ensures your organs are responding well to treatment.',
            },
            {
              icon: Activity,
              title: 'Measure real progress',
              desc: 'Weight on the scale tells only part of the story. Blood tests track improvements in HbA1c, triglycerides, inflammation, and metabolic health.',
            },
            {
              icon: Droplets,
              title: 'Detect the invisible',
              desc: 'Conditions like fatty liver disease, vitamin deficiencies, and thyroid dysfunction often show no outward symptoms. Blood tests catch them early.',
            },
            {
              icon: AlertTriangle,
              title: 'Avoid complications',
              desc: 'Rapid weight loss can occasionally affect kidney function, electrolytes, or gallbladder health. Proactive testing keeps your clinician informed.',
            },
          ].map((item) => {
            const Icon = item.icon
            return (
              <div key={item.title} className="bg-dark-card rounded-[16px] border border-border p-5 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <div className="w-9 h-9 rounded-xl bg-gold/10 flex items-center justify-center mb-3">
                  <Icon size={16} className="text-gold" />
                </div>
                <p className="text-sm font-semibold text-ink">{item.title}</p>
                <p className="text-xs text-slate mt-1 leading-relaxed">{item.desc}</p>
              </div>
            )
          })}
        </div>
      </div>

      {/* What we test */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <h2 className="text-lg font-bold text-ink mb-1">What we test and why</h2>
        <p className="text-sm text-slate mb-4 leading-relaxed">
          Our health check panels are specifically designed for patients on weight loss medication. Here is what your blood work covers:
        </p>
        <div className="grid sm:grid-cols-2 gap-3">
          {[
            { icon: HeartPulse, area: 'Liver function (ALT, AST, GGT)', why: 'GLP-1s are metabolised by the liver. We ensure your liver is coping well.' },
            { icon: FlaskConical, area: 'Kidney function (eGFR, creatinine)', why: 'Weight loss and dietary changes can affect kidney markers.' },
            { icon: Stethoscope, area: 'Thyroid panel (TSH, T3, T4)', why: 'Thyroid issues can cause weight changes and fatigue. We rule them out.' },
            { icon: Activity, area: 'Cholesterol & lipid profile', why: 'Track cardiovascular risk factors as they improve with weight loss.' },
            { icon: Droplets, area: 'HbA1c & blood glucose', why: 'Essential for monitoring insulin resistance and pre-diabetes risk.' },
            { icon: Shield, area: 'Full blood count & inflammation', why: 'Screens for anaemia, infection, and chronic inflammation.' },
          ].map((item) => {
            const Icon = item.icon
            return (
              <div key={item.area} className="flex items-start gap-3 bg-warm/50 rounded-xl p-3">
                <div className="w-8 h-8 rounded-lg bg-gold/10 flex items-center justify-center shrink-0 mt-0.5">
                  <Icon size={14} className="text-gold" />
                </div>
                <div>
                  <p className="text-xs font-semibold text-ink">{item.area}</p>
                  <p className="text-[11px] text-slate mt-0.5 leading-relaxed">{item.why}</p>
                </div>
              </div>
            )
          })}
        </div>
      </div>

      {/* Health check packages */}
      <div id="book-online">
        <div className="text-center mb-6">
          <span className="inline-block bg-sky-500/10 text-sky-400 text-[11px] font-bold tracking-widest uppercase px-4 py-1.5 rounded-full mb-3">BOOK ONLINE</span>
          <h2 className="text-xl font-bold text-ink tracking-tight">Book Your Health Check</h2>
          <p className="text-sm text-slate mt-2 max-w-lg mx-auto leading-relaxed">
            Appointments available at our <strong className="text-ink">London</strong> and <strong className="text-ink">St Albans</strong> clinics. Choose the package that suits your needs.
          </p>
        </div>

        <div className="grid sm:grid-cols-3 gap-4 mb-6">
          {[
            {
              name: 'Baseline',
              price: '199',
              markers: '30+ biomarkers',
              desc: 'Essential blood work including liver, kidney, thyroid, cholesterol, and blood glucose.',
              recommended: false,
              url: 'https://app.semble.io/book/don-t-weight-ltd/baseline-health-check',
            },
            {
              name: 'Standard',
              price: '360',
              markers: '40+ biomarkers',
              desc: 'Comprehensive panel with everything in Baseline plus cancer markers, vitamins, iron studies, and inflammation markers.',
              recommended: true,
              url: 'https://app.semble.io/book/don-t-weight-ltd/standard-health-check',
            },
            {
              name: 'Premium',
              price: '549',
              markers: '50+ biomarkers',
              desc: 'Our most thorough check including everything in Standard plus hormones, advanced cardiac risk, and detailed metabolic profiling.',
              recommended: false,
              url: 'https://app.semble.io/book/don-t-weight-ltd/comprehensive-health-check',
            },
          ].map((pkg) => (
            <div key={pkg.name} className={`bg-dark-card rounded-[16px] border p-6 flex flex-col relative ${pkg.recommended ? 'border-gold/40 ring-1 ring-gold/20' : 'border-border'}`}>
              {pkg.recommended && (
                <span className="absolute -top-3 left-1/2 -translate-x-1/2 bg-gold text-dark text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Recommended</span>
              )}
              <h3 className="text-lg font-bold text-ink">{pkg.name}</h3>
              <p className="text-xs text-slate mt-0.5 mb-3">{pkg.markers}</p>
              <p className="text-2xl font-bold text-ink mb-1">&pound;{pkg.price}</p>
              <p className="text-xs text-slate mb-4 flex-1 leading-relaxed">{pkg.desc}</p>
              <a
                href={pkg.url}
                target="_blank"
                rel="noopener noreferrer"
                className={`text-center text-sm font-semibold py-2.5 rounded-full transition-all hover:-translate-y-0.5 ${
                  pkg.recommended
                    ? 'bg-gold text-dark hover:bg-gold-light'
                    : 'border border-gold/30 text-gold hover:bg-gold/10'
                }`}
              >
                Book now
              </a>
            </div>
          ))}
        </div>
        <p className="text-[11px] text-slate text-center">Powered by London Private Ultrasound Group · CQC Registered</p>
      </div>

      {/* Trust footer */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <div className="flex items-center justify-center gap-2 mb-2">
          <Shield size={16} className="text-gold" />
          <p className="text-sm font-semibold text-ink">Health monitoring built in -- not bolted on</p>
        </div>
        <p className="text-xs text-slate max-w-xl mx-auto text-center leading-relaxed">
          Most online weight loss clinics prescribe medication without ongoing health screening. At Don't Weight, we believe responsible treatment means monitoring what matters. All blood tests are processed at UKAS-accredited UK laboratories, and every report is reviewed and annotated by a qualified clinician before it reaches you.
        </p>
        <div className="flex flex-wrap items-center justify-center gap-4 mt-4 text-[11px] text-slate">
          <span className="flex items-center gap-1"><CheckCircle2 size={12} className="text-emerald-400" /> UKAS-accredited labs</span>
          <span className="flex items-center gap-1"><CheckCircle2 size={12} className="text-emerald-400" /> CQC-registered clinic</span>
          <span className="flex items-center gap-1"><CheckCircle2 size={12} className="text-emerald-400" /> GMC-registered clinicians</span>
        </div>
      </div>

      {/* Booked checks */}
      {loading ? (
        <CardSkeleton />
      ) : bookings.length > 0 ? (
        <div className="bg-dark-card rounded-[16px] border border-border overflow-hidden">
          <div className="p-4 border-b border-border">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Your health checks</h2>
          </div>
          <div className="divide-y divide-border/50">
            {bookings.map((b) => (
              <div key={b.id} className="flex items-center justify-between p-4">
                <div>
                  <p className="text-sm font-medium text-ink capitalize">{b.package} Health Check</p>
                  <p className="text-xs text-slate">
                    {b.appointment_date
                      ? new Date(b.appointment_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })
                      : 'Date to be confirmed'}
                  </p>
                </div>
                <StatusBadge status={b.status} />
              </div>
            ))}
          </div>
        </div>
      ) : null}
    </div>
  )
}
