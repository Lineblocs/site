@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
<div class="resources-section resources-item section no-pad-bot" id="index-banner">
    <div class="container resource">
        <div class="row">
            <div class="col s12">
                <a href="/resources/">Resources</a> > <a
                    href="/resources/{{$theSection['link']}}">{{$theSection['name']}}</a> > {{$title}}
            </div>
        </div>
        <div class="row">
            <div class="col s12 l8">
                <div class="markdown">
                    {!! $html !!}
                </div>
            </div>
            <div class="col s12 l4 related-bar">
                <div class="inner">
                    <div class="side-block hide">
                        <h3>On This Page</h3>
                        <hr />
                        <ul id="onThisPage" class="related-items">
                        </ul>
                    </div>
                    <div class="side-block">
                        <h3>Related Items</h3>
                        <hr />
                        <ul class="related-items">
                            @foreach ($related as $item)
                            <li>
                                <a
                                    href="/resources/{{$item['section']['link']}}/{{$item['item']['link']}}">{{$item['item']['name']}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="support-btn">





                        <img src="/img/support.png" alt="support icon" />
                    </div>






                    <!-- mobile -->
                    <div class="card horizontal-rounded support-card">
                        <button class="support-card-close">
                            <svg width="17" height="17" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.726 15.402c.365.366.365.96 0 1.324-.178.178-.416.274-.663.274-.246 0-.484-.096-.663-.274L8.323 9.648h.353L1.6 16.726c-.177.178-.416.274-.663.274-.246 0-.484-.096-.663-.274-.365-.365-.365-.958 0-1.324L7.35 8.324v.35L.275 1.6C-.09 1.233-.09.64.274.274c.367-.365.96-.365 1.326 0l7.076 7.078h-.353L15.4.274c.366-.365.96-.365 1.326 0 .365.366.365.958 0 1.324L9.65 8.675v-.35l7.076 7.077z"
                                    fill="#000" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h5>Still need support ?</h5>
                                <br />
                                <p>
                                    We can help you with any questions you may have regarding
                                    this post.
                                </p>
                                <br />
                                <a class="btn-custom service-btn" href="/contact">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <!-- desktop -->
                    <div class="card horizontal-rounded support-card-desktop">
                        <button class="support-card-close">
                            <svg width="17" height="17" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.726 15.402c.365.366.365.96 0 1.324-.178.178-.416.274-.663.274-.246 0-.484-.096-.663-.274L8.323 9.648h.353L1.6 16.726c-.177.178-.416.274-.663.274-.246 0-.484-.096-.663-.274-.365-.365-.365-.958 0-1.324L7.35 8.324v.35L.275 1.6C-.09 1.233-.09.64.274.274c.367-.365.96-.365 1.326 0l7.076 7.078h-.353L15.4.274c.366-.365.96-.365 1.326 0 .365.366.365.958 0 1.324L9.65 8.675v-.35l7.076 7.077z"
                                    fill="#000" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h5>Still need support ?</h5>
                                <br />
                                <p>
                                    We can help you with any questions you may have regarding
                                    this post.
                                </p>
                                <br />
                                <a class="btn-custom service-btn" href="/contact">Contact Us</a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        function gotoSection(slug, animate) {
            if (typeof animate !== 'undefined' && !animate) {
                animate = false;
            } else {
                animate = true;
            }
            var pos = $("#" + slug).offset().top;

            if (animate) {
                $('html, body').animate({
                    scrollTop: pos
                }, 1000);
                return;
            }
            window.scrollTo(0, pos);
        }
        window.addEventListener("load", function () {
            $(".markdown a").each(function () {
                $(this).attr("target", "_blank");
            });
            $("h2").each(function () {
                var text = $(this).text();
                var slug = slugify(text);
                if (slug === 'next-steps') { // dont include
                    return;
                }
                var li = $("<li></li>");
                var a = $("<a></a>");
                a.text(text);
                a.appendTo(li);
                li.appendTo($("#onThisPage"));
                $(this).attr("id", slug);
                a.attr("href", "#" + slug);
                a.click(function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    gotoSection(slug);
                    document.location.hash = "#" + slug;
                });
            });
            var hash = window.location.hash;
            if (hash !== '') {
                setTimeout(function () {
                    gotoSection(hash.split("#")[1], false);
                }, 0);
            }
        });
    </script>
        <script src="/js/components/resourcesItemSupportCard.js"></script>

    @endsection