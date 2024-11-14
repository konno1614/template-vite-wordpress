export const common = () => {
    console.log("common");

    // Smooth Scroll
    function setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function (this: HTMLAnchorElement, event) {
                event.preventDefault();
                const targetId = this.getAttribute('href')?.substring(1);
                const targetElement = targetId ? document.getElementById(targetId) : null;
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    // Hamburger & SP-Nav
    function setupHamburgerMenu() {
        const toggleNav = document.querySelector(".js-hamburger");
        const nav = document.querySelector(".js-nav");
        const body = document.body;

        const toggleClasses = (action: "add" | "remove" | "toggle") => {
            [toggleNav, nav, body].forEach(el => el?.classList[action]("is-open"));
        };

        toggleNav?.addEventListener("click", () => toggleClasses("toggle"));
        document.querySelectorAll(".c-nav ul li a").forEach(link =>
            link.addEventListener("click", () => toggleClasses("remove"))
        );
        window.addEventListener("resize", () => toggleClasses("remove"));
    }

    function init() {
        setupSmoothScroll();
        setupHamburgerMenu();
    }

    init();
};
