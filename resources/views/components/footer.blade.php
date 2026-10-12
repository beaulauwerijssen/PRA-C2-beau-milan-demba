<footer class="site-footer mt-5">
    <div class="site-footer__inner">
        <div class="site-footer__top">
            <div class="site-footer__brand-block">
                <div class="site-footer__brand">
                    {{ config('app.name', 'PRA-C2') }}
                </div>
                <p class="site-footer__tagline">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>

            <div class="site-footer__info">
                <h3>Contact</h3>
                <ul>
                    <li><a href="mailto:lorem@ipsum.com">lorem@ipsum.com</a></li>
                    <li><a href="tel:+310200000000">+31 (0)20 000 0000</a></li>
                    <li>Lorem ipsum street 42</li>
                </ul>
            </div>

            <div class="site-footer__info">
                <h3>Follow us</h3>
                <ul>
                    <li><a href="#">Instagram @loremipsum</a></li>
                    <li><a href="#">Facebook /loremipsum</a></li>
                    <li><a href="#">Pinterest /loremipsum</a></li>
                </ul>
            </div>
        </div>

        <div class="site-footer__bottom">
            <div class="site-footer__meta">
                <a href="{{ route('about') }}">{{ __('misc.about_us') }}</a>
                <a href="{{ route('contact') }}">{{ __('misc.contact') }}</a>
            </div>

            <p>{{ __('misc.copyright') }}</p>

            <div class="site-footer__language">
                <span class="small mr-2">{{ __('misc.language') }}:</span>
                <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('misc.language') }}">
                    <a href="{{ route('change.locale', ['language_slug' => 'nl']) }}"
                       class="btn btn-link px-2 py-1 {{ app()->getLocale() === 'nl' ? 'text-white font-weight-bold' : 'text-white-50' }}"
                       aria-label="Nederlands">NL</a>
                    <a href="{{ route('change.locale', ['language_slug' => 'en']) }}"
                       class="btn btn-link px-2 py-1 {{ app()->getLocale() === 'en' ? 'text-white font-weight-bold' : 'text-white-50' }}"
                       aria-label="English">EN</a>
                </div>
            </div>
        </div>
    </div>
</footer>



<!-- analytics code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30506707-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- Einde analytics code -->

<script language="Javascript" type="text/javascript">

 if (top.location!= self.location) {
  top.location = self.location.href
 }

</script>
