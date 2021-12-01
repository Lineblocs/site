@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
    <main>
        <!-- <section class="two-column full-section features-1"> -->
        <section class="two-column features-1">
            <h1 class="text-center">Features</h1>
            
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 my-auto image">
                            <img src="./images/featured-top.png" alt="" class="desktop">
                            <img src="./images/featured-mobile.png" alt="" class="mobile-only">
                        </div>
                        <div class="col-12 col-md-5 my-auto">
                            <h2 class="text-left">Low-Code Flow Editor</h2>
                            <p>Get access to an all-in-one flow editor that allows you to create highly customizable workflows for calls, fax, and IM. Our flow editor can be used to generate any calling workflow imaginable.</p>
                            <a href="https://app.lineblocs.com/#/register" class="button btn primary-button">Create account</a>
                        </div>
                    </div>
                </div>
            </div>
                
        
        </section>

        <section class="two-column">
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5 my-auto">
                            <h2 class="text-left">DID number portal</h2>
                            <p>Purchase numbers from a DID inventory that includes local, toll free, and vanity-based numbers. We also offer a full range of DIDs that span across multiple rate centers throughout North America.</p>
                            <a href="https://app.lineblocs.com/#/register" class="button btn primary-button">Create account</a>
                        </div>
                        <div class="col-12 col-md-6 my-auto text-center">
                            <img src="./images/two-phones.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="two-column">
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 my-auto">
                            <img src="./images/map.png" alt="" class="img-fluid">
                        </div>
                        <div class="col-12 col-md-5 my-auto">
                            <h2 class="text-left">PoPs and high availability</h2>
                            <p>Our network allows you to provision extensions nearest to your location and rotates from more than 10+ PoPs across North America.</p>
                            <a href="https://app.lineblocs.com/#/register" class="button btn primary-button">Create account</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="blue-section">
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-12 col-lg-6 my-auto">
                            <h2 class="text-left">Overcome Challenges with existing on-premise calling solutions</h2>
                            <p>Designed using the best technologies, Lineblocs offers features that can help you create a calling, fax, and IM environment that can easily scale.</p>
                            <a href="https://app.lineblocs.com/#/register" class="button btn primary-button bg-blue">Create account</a>
                        </div>
                        <div class="col-12 col-lg-6 my-auto desktop-images">
                            <div class="row">
                                <div class="col-4 col-lg-6 my-auto column1">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="./images/p1.png" alt="Card image cap" class="tile"></div>
                                        </div>
                                    </div>
                                    
                                <div class="col-8 col-lg-6 column2">
                                    <div class="row">
                                        <div class="col-6 col-lg-12 col-img">
                                            <img src="./images/p2.png" alt="Card image cap" class="tile">
                                        </div>
                                        <div class="col-6 col-lg-12 col-img">
                                            <img src="./images/p3.png" alt="Card image cap" class="tile">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>                            
                        </div>
                        <div class="col-12 col-lg-6 mobile-images">
                            <div class="row">
                                <div class="col-4">
                                    <img src="./images/p1.png" alt="Card image cap" class="tile img-fluid">
                                </div>
                                <div class="col-4">
                                    <img src="./images/p2.png" alt="Card image cap" class="tile img-fluid">
                                </div>
                                <div class="col-4">
                                    <img src="./images/p3.png" alt="Card image cap" class="tile img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="overview">
            <div class="inner-holder">
                <div class="container">
                    <h2>An Overview</h2>
                    <div class="row ov-row">
                        <div class="col-12 col-md-6">
                            <div class="ov-block">
                                <div class="row">
                                    <div class="col-12 col-lg-2 icon-holder my-auto">
                                        <img src="./images/icon-shield.png" alt="" class="icon">
                                    </div>
                                    <div class="col-12 col-lg-10 heading">
                                        <h3>High Availability</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-2 content">
                                        <p>Our network is made up of best practices and created using secure technologies.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ov-block">
                                <div class="row">
                                    <div class="col-12 col-lg-2 icon-holder my-auto">
                                        <img src="./images/icon-cell.png" alt="" class="icon">
                                    </div>
                                    <div class="col-12 col-lg-10 heading">
                                        <h3>Number Inventory</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-2 content">
                                        <p>Self-serve number rental and management in one easy to use number management portal.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row ov-row">
                        <div class="col-12 col-md-6">
                            <div class="ov-block">
                                <div class="row">
                                    <div class="col-12 col-lg-2 icon-holder my-auto">
                                        <img src="./images/icon-cloud.png" alt="" class="icon">
                                    </div>
                                    <div class="col-12 col-lg-10 heading">
                                        <h3>Scalable Services</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-2 content">
                                        <p>Our cloud network is built with scale in mind – all of it – including our software, user portals, and network.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ov-block">
                                <div class="row">
                                    <div class="col-12 col-lg-2 icon-holder my-auto">
                                        <img src="./images/icon-screen.png" alt="" class="icon">
                                    </div>
                                    <div class="col-12 col-lg-10 heading">
                                        <h3>Low-Code</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-2 content">
                                        <p>Our solutions are entirely based on low-code integrations, allowing teams to create high-level workflows.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-form">
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                           
                                <h2>Learn More</h2>
                                <p>Have queries regarding our offerings? Feel free to contact us.</p>

                                <form>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                          <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control" id="textArea" placeholder="Message" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn button" type="submit">Send message</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <small id="ppInfo" class="text-muted">
                                                By clicking the button, you agree to Line block   
                                            </small>
                                        </div>
                                    </div>      
                                </form>
                            
                        </div>
                        <div class="col-12 col-md-6 mobile-hidden my-auto">
                            <img src="./images/cf-img.png" alt="Man" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection
@section('scripts')
<script>
</script>
@endsection
