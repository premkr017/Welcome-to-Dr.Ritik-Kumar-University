
    <link rel="stylesheet" href="style.css">


<header>
    <div class="container">
        <div class="logo">MyCollege</div>

        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Admissions</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div class="menu-icon" id="menuBtn">
            ☰
        </div>
    </div>

    <!-- Mobile Menu -->
    <ul class="mobile-menu" id="mobileMenu">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Courses</a></li>
        <li><a href="#">Admissions</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

</header>

<script>
    const btn = document.getElementById("menuBtn");
    const menu = document.getElementById("mobileMenu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("show");
    });
</script>
