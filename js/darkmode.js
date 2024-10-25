function toggleTheme() {
    const body = document.body;
    body.classList.toggle("dark-mode");
    const darkMode = body.classList.contains("dark-mode");
    localStorage.setItem("theme", darkMode ? "dark" : "light");

    // Change background color based on theme
    if (darkMode) {
        body.style.backgroundColor = "#1a1a1a"; // Dark background
    } else {
        body.style.backgroundColor = "#ffffff"; // Light background
    }
}

window.onload = function () {
    const theme = localStorage.getItem("theme") || "light";
    if (theme === "dark") {
        document.body.classList.add("dark-mode");
        document.body.style.backgroundColor = "#1a1a1a"; // Dark background on load
    } else {
        document.body.style.backgroundColor = "#ffffff"; // Light background on load
    }
};
