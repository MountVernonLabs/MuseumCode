<div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent uk-light; top: 200">

    <nav class="uk-navbar-container">
        <div class="uk-container uk-container-expand">
            <div uk-navbar>
              <div class="uk-navbar-left">
                <a class="uk-navbar-item uk-logo" href="/">MuseumCODE</a>
                <br>
                <ul class="uk-navbar-nav">
                    <li><a href="/projects">Projects</a></li>
                </ul>
              </div>
              <div class="uk-navbar-right">
                <div class="uk-navbar-item">
                    <form id="search" action="/search" method="get">
                        <input class="uk-input uk-form-width-small" name="q" type="text" placeholder="search">
                        <a class="uk-button uk-padding-remove-horizontal uk-padding-left-small uk-margin-small-left" onclick="document.getElementById('search').submit();"><span class="uk-margin-small-right" uk-icon="search"></span></a>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </nav>
</div>
