<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }} class="smart-bin">
    <!-- Définition des gradients -->
    <defs>
        <linearGradient id="bodyGradient" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#FCD34D" />
            <stop offset="100%" style="stop-color:#F59E0B" />
        </linearGradient>
        <pattern id="circuit" patternUnits="userSpaceOnUse" width="20" height="20">
            <path d="M5 5 H15 V15 H5 Z" fill="none" stroke="#F6E05E" stroke-width="0.5"/>
            <circle cx="10" cy="10" r="2" fill="#F6E05E"/>
        </pattern>
        <linearGradient id="lidGradient" x1="0%" y1="0%" x2="100%">
            <stop offset="0%" style="stop-color:#FCD34D"/>
            <stop offset="100%" style="stop-color:#F59E0B"/>
        </linearGradient>
    </defs>

    <!-- Couvercle -->
    <g class="lid">
        <!-- Charnières -->
        <circle cx="25" cy="40" r="2" fill="#D97706"/>
        <circle cx="75" cy="40" r="2" fill="#D97706"/>

        <!-- Couvercle principal -->
        <path d="M20 40 L80 40 L75 30 L25 30 Z" fill="url(#lidGradient)"/>

        <!-- Poignée -->
        <rect x="45" y="28" width="10" height="3" rx="1" fill="#D97706"/>

        <!-- Capteur d'ouverture -->
        <circle cx="50" cy="35" r="2" class="lid-sensor" fill="#10B981"/>
    </g>

    <!-- Corps principal -->
    <rect x="25" y="40" width="50" height="55" rx="5" fill="url(#bodyGradient)" class="bin-body"/>

    <!-- Circuits imprimés décoratifs -->
    <rect x="30" y="45" width="40" height="45" fill="url(#circuit)" opacity="0.2"/>

    <!-- Écran LED -->
    <rect x="35" y="50" width="30" height="15" rx="2" fill="#1F2937" class="screen"/>
    <text x="50" y="60" text-anchor="middle" fill="#10B981" class="screen-text">00101</text>

    <!-- Capteurs -->
    <circle cx="35" cy="75" r="3" fill="#10B981" class="sensor sensor1"/>
    <circle cx="65" cy="75" r="3" fill="#10B981" class="sensor sensor2"/>

    <!-- Ondes WiFi améliorées -->
    <path d="M50 20 Q65 20 75 10" stroke="#4FD1C5" fill="none" class="wifi-wave wave1" stroke-width="2"/>
    <path d="M50 20 Q65 25 70 15" stroke="#4FD1C5" fill="none" class="wifi-wave wave2" stroke-width="2"/>
    <path d="M50 20 Q65 30 65 20" stroke="#4FD1C5" fill="none" class="wifi-wave wave3" stroke-width="2"/>

    <!-- Symbole WiFi -->
    <g class="wifi-symbol" transform="translate(65, 15) scale(0.5)">
        <path class="wifi-wave1" d="M0,20 Q15,20 15,0 Q15,20 30,20" fill="none" stroke="#4FD1C5" stroke-width="3"/>
        <path class="wifi-wave2" d="M5,20 Q15,20 15,5 Q15,20 25,20" fill="none" stroke="#4FD1C5" stroke-width="3"/>
        <path class="wifi-wave3" d="M10,20 Q15,20 15,10 Q15,20 20,20" fill="none" stroke="#4FD1C5" stroke-width="3"/>
        <circle cx="15" cy="20" r="2" fill="#4FD1C5"/>
    </g>
</svg>

<style>
.smart-bin {
    overflow: visible;
}

.wifi-wave {
    opacity: 0;
    animation: wave 2s infinite;
}

.wave1 { animation-delay: 0s; }
.wave2 { animation-delay: 0.4s; }
.wave3 { animation-delay: 0.8s; }

.sensor {
    animation: pulse 2s infinite;
}

.sensor2 {
    animation-delay: 1s;
}

.screen-text {
    font-family: monospace;
    font-size: 8px;
    animation: blink 1s infinite;
}

.lid {
    transform-origin: 50% 40%;
    animation: lidMove 4s infinite;
}

.lid-sensor {
    animation: sensorBlink 4s infinite;
}

.wifi-wave1, .wifi-wave2, .wifi-wave3 {
    opacity: 0;
    transform-origin: center;
}

.wifi-wave1 {
    animation: wifiPulse 2s infinite;
}

.wifi-wave2 {
    animation: wifiPulse 2s infinite 0.4s;
}

.wifi-wave3 {
    animation: wifiPulse 2s infinite 0.8s;
}

@keyframes wave {
    0% { opacity: 0; transform: translateY(0); }
    50% { opacity: 1; transform: translateY(-2px); }
    100% { opacity: 0; transform: translateY(-4px); }
}

@keyframes pulse {
    0% { opacity: 0.3; r: 2; }
    50% { opacity: 1; r: 3; }
    100% { opacity: 0.3; r: 2; }
}

@keyframes blink {
    0% { opacity: 0.5; }
    50% { opacity: 1; }
    100% { opacity: 0.5; }
}

@keyframes lidMove {
    0%, 100% { transform: rotateX(0deg); }
    45%, 55% { transform: rotateX(-45deg); }
}

@keyframes sensorBlink {
    0%, 100% { fill: #10B981; }
    45%, 55% { fill: #F59E0B; }
}

@keyframes wifiPulse {
    0% { opacity: 0; transform: scale(0.8); }
    50% { opacity: 1; transform: scale(1); }
    100% { opacity: 0; transform: scale(1.2); }
}
</style>
