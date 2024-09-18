import "flowbite";
import { Dropdown } from "flowbite";

document.openDropdown = function (dropdownId) {
    const dropdownEl = document.getElementById(dropdownId);
    if (dropdownEl) {
        const dropdown = new Dropdown(dropdownEl, event.currentTarget, {});
        dropdown.toggle();
    }
};

document.addEventListener("closeToast", function () {
    if (livewire) {
        setTimeout(() => {
            livewire.emitTo("modules.toast", "closeToast");
        }, 3000);
    }
});

// document.addEventListener("refreshComponent", function () {
//     var test = new DataTable("#example");

// });

document.addEventListener("playAudio", function () {
    const existingAudio = document.querySelector("audio.playing");
    if (existingAudio) {
        existingAudio.pause();
        existingAudio.classList.remove("playing");
    }

    const audio = document.getElementById("playAudio");

    audio.addEventListener("ended", function () {
        window.Livewire.dispatch("playRecordingEnded");
    });

    audio.addEventListener("canplaythrough", function () {
        audio.play();
        audio.classList.add("playing");
    });

    audio.load();
});

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");

    if (sidebar) {
        const toggleSidebarMobile = (
            sidebar,
            sidebarBackdrop,
            toggleSidebarMobileHamburger,
            toggleSidebarMobileClose
        ) => {
            sidebar.classList.toggle("hidden");
            sidebarBackdrop.classList.toggle("hidden");
            toggleSidebarMobileHamburger.classList.toggle("hidden");
            toggleSidebarMobileClose.classList.toggle("hidden");
        };

        const toggleSidebarMobileEl = document.getElementById(
            "toggleSidebarMobile"
        );
        const sidebarBackdrop = document.getElementById("sidebarBackdrop");
        const toggleSidebarMobileHamburger = document.getElementById(
            "toggleSidebarMobileHamburger"
        );
        // const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');
        // const toggleSidebarMobileSearch = document.getElementById('toggleSidebarMobileSearch');

        // toggleSidebarMobileSearch.addEventListener('click', () => {
        //     toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
        // });

        // toggleSidebarMobileEl.addEventListener('click', () => {
        //     toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
        // });

        sidebarBackdrop.addEventListener("click", () => {
            toggleSidebarMobile(
                sidebar,
                sidebarBackdrop,
                toggleSidebarMobileHamburger,
                toggleSidebarMobileClose
            );
        });
    }

    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }

    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );
});
