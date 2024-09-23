import "./bootstrap";
import Alpine from "alpinejs";
import "preline";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
})