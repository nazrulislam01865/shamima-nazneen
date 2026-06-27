@switch($name)
    @case('home')<svg viewBox="0 0 24 24"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10M9 20v-6h6v6"/></svg>@break
    @case('video')<svg viewBox="0 0 24 24"><rect x="3" y="5" width="14" height="14" rx="2"/><path d="m17 10 4-2v8l-4-2z"/></svg>@break
    @case('chevron-down')<svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>@break
    @case('grid')<svg viewBox="0 0 24 24"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/></svg>@break
    @case('user')<svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>@break
    @case('settings')<svg viewBox="0 0 24 24"><path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm8.5 4a7 7 0 0 0-.1-1.2l2-1.5-2-3.4-2.4 1a8 8 0 0 0-2-1.2L15.7 3h-4l-.4 2.7a8 8 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.5A7 7 0 0 0 6.8 12c0 .4 0 .8.1 1.2l-2 1.5 2 3.4 2.4-1a8 8 0 0 0 2 1.2l.4 2.7h4l.4-2.7a8 8 0 0 0 2-1.2l2.4 1 2-3.4-2-1.5c.1-.4.1-.8.1-1.2Z"/></svg>@break
    @case('layout')<svg viewBox="0 0 24 24"><path d="M3 4h18v16H3zM3 9h18M9 9v11"/></svg>@break
    @case('image')<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8" cy="9" r="2"/><path d="m4 18 5-5 3 3 3-3 5 5"/></svg>@break
    @case('book')<svg viewBox="0 0 24 24"><path d="M4 4h11a3 3 0 0 1 3 3v13H7a3 3 0 0 1-3-3V4Zm14 3h2v13h-2"/></svg>@break
    @case('folder')<svg viewBox="0 0 24 24"><path d="M3 6h7l2 2h9v11H3z"/></svg>@break
    @case('film')<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 4v16M17 4v16M3 9h4M3 15h4M17 9h4M17 15h4"/></svg>@break
    @case('gallery')<svg viewBox="0 0 24 24"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="m4 15 4-4 3 3 2-2 4 4M8 8h.01M7 21h12a2 2 0 0 0 2-2V7"/></svg>@break
    @case('quote')<svg viewBox="0 0 24 24"><path d="M5 7h6v6H7v4H4v-7a3 3 0 0 1 3-3Zm10 0h6v6h-4v4h-3v-7a3 3 0 0 1 3-3Z"/></svg>@break
    @case('calendar')<svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18"/></svg>@break
    @case('mail')<svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg>@break
    @case('link')<svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1.2 1.2"/><path d="M14 11a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1.2-1.2"/></svg>@break
@endswitch
