export default function MessageBubble({ message, isOwn }) {
  const time = new Date(message.created_at).toLocaleTimeString('en-GB', {
    hour: '2-digit',
    minute: '2-digit',
  })

  return (
    <div className={`flex ${isOwn ? 'justify-end' : 'justify-start'} mb-3`}>
      <div className={`max-w-[75%] px-4 py-2.5 rounded-2xl ${
        isOwn
          ? 'bg-gold text-dark rounded-br-md'
          : 'bg-warm text-ink rounded-bl-md'
      }`}>
        <p className="text-sm leading-relaxed whitespace-pre-wrap">{message.content}</p>
        <p className={`text-[10px] mt-1 ${isOwn ? 'text-dark/60' : 'text-slate'}`}>{time}</p>
      </div>
    </div>
  )
}
