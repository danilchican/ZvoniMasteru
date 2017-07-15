<!-- Footer -->
<div id="footer" class="visible-md visible-lg">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <ul id="socials-footer">
                    <li><a href=""><img src="/assets/images/socials/vk.png" alt="Мы в Вконтакте"></a></li>
                    <li><a href=""><img src="/assets/images/socials/ok.png" alt="Мы в Одноклассниках"></a></li>
                    <li><a href=""><img src="/assets/images/socials/insta.png" alt="Мы в Инстаграме"></a></li>
                </ul>
            </div>
            <div class="row">
                <ul id="footer-menu">
                    <li class="main-icon"><a href="">Главная</a></li>
                    <li><a href="">Каталог</a></li>
                    <li><a href="">Вопрос-ответ</a></li>
                </ul>
            </div>
            <div class="row">
                <p class="copyright">Студия “Трендмастер”, 2017
                    <div class="container" style="margin-top: 20px;">
                        <!-- Yandex.Metrika informer -->
                        <a href="https://metrika.yandex.ru/stat/?id=44565265&from=informer" target="_blank" rel="nofollow">
                            <img src="https://informer.yandex.ru/informer/44565265/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                 style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                                 title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                                 class="ym-advanced-informer" data-cid="44565265" data-lang="ru"/>
                        </a>
                        <!-- /Yandex.Metrika informer -->
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Auth -->
<div class="modal fade" id="modal-auth" tabindex="-1" role="dialog" aria-labelledby="modalAuthLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalAuthLabel">Войти в личный кабинет</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="/login">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Логин" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Пароль" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-sm-7 col-xs-6 full-width-xs">
                            <a class="btn btn-link" href="/password/reset">Забыли пароль?</a>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-6 text-align-right full-width-xs">
                            <input type="checkbox" name="remember" checked> Запомнить меня
                        </div>
                    </div>
                    <div class="form-group btn-form-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="socials-auth-title">Вход через социальные сети:</p>
                <ul class="socials-auth-variant">
                    <li>
                        <a href=""><img src="./assets/images/socials/auth/vk.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="./assets/images/socials/auth/fb.png" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registration -->
<div class="modal fade" id="modal-registration" tabindex="-1" role="dialog" aria-labelledby="modalRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalRegistrationLabel">Регистрация</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="/register">
                    <input type="hidden" name="">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="company-name-reg" type="text" class="form-control" name="company_name_reg" placeholder="Название фирмы">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="email-reg" type="email" class="form-control" name="email_reg" placeholder="E-mail" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password-reg" type="password" class="form-control" name="password_reg" placeholder="Пароль" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="password-confirm-reg" type="password" class="form-control" name="password_confirmation_reg" placeholder="Повторите пароль" required>
                        </div>
                    </div>
                    <div class="form-group btn-form-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="socials-auth-title">Вход через социальные сети:</p>
                <ul class="socials-auth-variant">
                    <li>
                        <a href=""><img src="./assets/images/socials/auth/vk.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="./assets/images/socials/auth/fb.png" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Compiled plugins -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/scripts.js"></script>
@yield('scripts')
<!-- Yandex.Metrika counter -->
<script type="text/javascript"> (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter44565265 = new Ya.Metrika({
                    id: 44565265,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true,
                    trackHash: true,
                    ecommerce: "dataLayer"
                });
            } catch (e) {
            }
        });
        var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
            n.parentNode.insertBefore(s, n);
        };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->
</body>
</html>