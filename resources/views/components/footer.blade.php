<footer>
    <p>{{ __('misc.copyright') }}</p>

    <div class="footer-links d-flex align-items-center justify-content-center gap-2 flex-wrap">
        <a href="{{ route('about') }}">{{ __('misc.about_us') }}</a> |
        <a href="{{ route('contact') }}">{{ __('misc.contact') }}</a>
    </div>

    <div class="footer-language mt-2 text-center">
        <span class="small mr-2">{{ __('misc.language') }}:</span>
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('misc.language') }}">
            <a href="{{ route('change.locale', ['language_slug' => 'nl']) }}"
               class="btn btn-link px-2 py-1 {{ app()->getLocale() === 'nl' ? 'text-dark font-weight-bold' : 'text-muted' }}"
               aria-label="Nederlands">NL</a>
            <a href="{{ route('change.locale', ['language_slug' => 'en']) }}"
               class="btn btn-link px-2 py-1 {{ app()->getLocale() === 'en' ? 'text-dark font-weight-bold' : 'text-muted' }}"
               aria-label="English">EN</a>
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
