<?php
class Header
{
    public function __construct(
        public $dots = ".."
    ) {}

    public function setDots($newDots){
        $this->dots = $newDots;
    }

    public function toHTML()
    {
        // Incluir sesiones para verificar login
        require_once $this->dots . '/Back/core/sesiones.php';
        $isLoggedIn = isUserLoggedIn();
        $user = $isLoggedIn ? getUserSession() : null;

        // Preparar url de avatar (permitir rutas absolutas o relativas)
        $avatarUrl = $this->dots . '/recursos/img/sinperfil.webp';
        if ($user && !empty($user['profile_picture_url'])) {
            $rawUrl = $user['profile_picture_url'];
            if (preg_match('#^https?://#i', $rawUrl)) {
                $avatarUrl = $rawUrl;
            } else {
                $avatarUrl = $this->dots . '/' . ltrim($rawUrl, "/");
            }
        }

        return "
            <header class=\"navbar navbar-expand-lg navbar-light bg-white shadow-sm luckiestGuyFontFamily\">
                <div class=\"container-fluid\">
                    <a class=\"navbar-brand d-flex align-items-center gap-2\" href=\"{$this->dots}/index.php\">
                        <img src=\"{$this->dots}/recursos/img/VEX_logo.png\" alt=\"VEX\" style=\"height: 40px;\">
                        <span class=\"fw-bold\">VEX</span>
                    </a>

                    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>

                    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                        <ul class=\"navbar-nav me-auto mb-2 mb-lg-0 gap-2\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link border border-2 border-dark rounded-pill bg-white px-3 py-2\" href=\"{$this->dots}/Back/games/gamesPage.php\">Browse Games</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link border border-2 border-dark rounded-pill bg-white px-3 py-2\" href=\"{$this->dots}/Back/games/formGameRegister.php\">Upload Game</a>
                            </li>
                        </ul>

                        <ul class=\"navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-2\">
                            " . (!$isLoggedIn ? "
                                <li class=\"nav-item\">
                                    <a class=\"nav-link border border-2 border-dark rounded-pill bg-white px-3 py-2\" href=\"{$this->dots}/Back/auth/formUserLogin.php\">Login</a>
                                </li>
                                <li class=\"nav-item\">
                                    <a class=\"nav-link border border-2 border-dark rounded-pill bg-white px-3 py-2\" href=\"{$this->dots}/Back/auth/formUserRegister.php\">Register</a>
                                </li>
                            " : "
                                <li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle d-flex align-items-center gap-2\" href=\"#\" id=\"userDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <img src=\"{$avatarUrl}\" alt=\"" . htmlspecialchars($user['username'] ?? '') . "\" class=\"rounded-circle border border-2 border-dark\" style=\"width: 40px; height: 40px; object-fit: cover;\">
                                        <span class=\"d-none d-lg-inline\">" . htmlspecialchars($user['username'] ?? '') . "</span>
                                    </a>
                                    <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userDropdown\">
                                        <li><a class=\"dropdown-item\" href=\"{$this->dots}/Back/auth/logout.php\">Log out</a></li>
                                    </ul>
                                </li>
                            ") . "
                        </ul>
                    </div>
                </div>
            </header>
        ";
    }
}
