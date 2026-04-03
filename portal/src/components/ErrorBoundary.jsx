import { Component } from 'react'
import { AlertTriangle, RefreshCw } from 'lucide-react'

export default class ErrorBoundary extends Component {
  constructor(props) {
    super(props)
    this.state = { hasError: false, error: null }
  }

  static getDerivedStateFromError(error) {
    return { hasError: true, error }
  }

  handleReset = () => {
    this.setState({ hasError: false, error: null })
  }

  render() {
    if (this.state.hasError) {
      return (
        <div className="min-h-screen bg-cream flex items-center justify-center p-4">
          <div className="max-w-md w-full text-center">
            <div className="w-16 h-16 bg-dark-card rounded-full flex items-center justify-center mx-auto mb-6">
              <AlertTriangle size={28} className="text-coral" />
            </div>
            <h1 className="text-2xl font-bold text-ink tracking-tight mb-2">
              Something went wrong
            </h1>
            <p className="text-sm text-slate mb-6">
              An unexpected error occurred. Please try refreshing the page or contact support if the problem persists.
            </p>
            <div className="flex gap-3 justify-center">
              <button
                onClick={this.handleReset}
                className="flex items-center gap-2 bg-gold text-dark font-semibold px-5 py-2.5 rounded-full hover:bg-gold-light transition-colors"
              >
                <RefreshCw size={14} /> Try again
              </button>
              <button
                onClick={() => window.location.reload()}
                className="flex items-center gap-2 border border-stone text-ink font-medium px-5 py-2.5 rounded-full hover:bg-warm transition-colors"
              >
                Refresh page
              </button>
            </div>
          </div>
        </div>
      )
    }

    return this.props.children
  }
}
