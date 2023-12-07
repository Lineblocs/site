<div class="mobile-navbar">
    <select class="browser-default" id="selectbox">
        <option value="/pages/privacy-policy"{{ Request::is('pages/privacy-policy') ? ' selected' : '' }}>PRIVACY POLICY</option>
        <option value="/pages/tos"{{ Request::is('pages/tos') ? ' selected' : '' }}>TERMS OF SERVICE</option>
        <option value="/pages/service-agreement"{{ Request::is('pages/service-agreement') ? ' selected' : '' }}>SERVICE LEVEL AGREEMENT</option>
    </select>
</div>

<div class="sidebar">
    <p><a href="/pages/privacy-policy"{{ Request::is('pages/privacy-policy') ? ' class=active' : '' }}>PRIVACY POLICY</a></p>
    <p><a href="/pages/tos"{{ Request::is('pages/tos') ? ' class=active' : '' }}>TERMS OF SERVICE</a></p>
    <p><a href="/pages/service-agreement"{{ Request::is('pages/service-agreement') ? ' class=active' : '' }}>SERVICE LEVEL AGREEMENT</a></p>
</div>

