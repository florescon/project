@php
    // Ahora usa $getState() en lugar de acceder directamente a $record
    $remainingSeconds = $getState();
@endphp

<div x-data="{
    remainingSeconds: {{ $remainingSeconds }},
    init() {
        setInterval(() => {
            this.remainingSeconds = Math.max(0, this.remainingSeconds - 1);
        }, 1000);
    },
    formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
}">
    <span x-text="formatTime(remainingSeconds)"></span>
</div>