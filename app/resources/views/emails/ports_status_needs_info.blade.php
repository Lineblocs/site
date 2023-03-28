<h2>{{\App\Helpers\MainHelper::getSiteName()}}</h2>

<div>
    <h5>Hello {{$user->getName()}},</h5>
    <p>We are emailing you to let you know that your port request for number {{$port->number}} needs additional info. below is the info required:

        {{$port->info_needed}}
    </p>
    <br/>
    <br/>
</div>
