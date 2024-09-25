import "./bootstrap";
import Alpine from "alpinejs";
import "preline";
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
})