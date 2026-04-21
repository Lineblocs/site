<div id="footer">
    <div class="container">
        <p class="text-muted credit"><span style="text-align: left; float: left">&copy; 2015 <a href="#">
            {{\Config::get('app.name')}}
        </a></span></p>
    </div>
</div>
<script>
//Set your APP_ID
var APP_ID = "q1wbd2t4";

window.intercomSettings = {
    app_id: APP_ID
  };
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>