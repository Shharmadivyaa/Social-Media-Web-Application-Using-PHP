const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch");
    
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });