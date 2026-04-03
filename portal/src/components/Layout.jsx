import { useState } from 'react'
import Sidebar from './Sidebar'
import TopBar from './TopBar'

export default function Layout({ children }) {
  const [collapsed] = useState(false)

  return (
    <div className="min-h-screen bg-cream">
      <Sidebar collapsed={collapsed} />
      <div className={`transition-all ${collapsed ? 'md:ml-16' : 'md:ml-60'}`}>
        <TopBar />
        <main className="p-4 md:p-8 pb-24 md:pb-8">
          {children}
        </main>
      </div>
    </div>
  )
}
