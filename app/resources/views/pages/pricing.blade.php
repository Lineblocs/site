@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')

<div class="pricing">
    <section class="cards-section">
      <div class="container">
        <div class="service">
          <h2 class="serviceheading2">
            Pricing
          </h2>
          <h5 class="serviceinfo">Pricing options suitable for teams of all sizes</h5>
        </div>
      </div>
    </section>
    <div class="section no-pad-bot" id="index-banner">





      <section class="cards-section">
        <div class="container">

          <div class="row no-margin">

            <div class=" col-s12 col-md-3">
              <div class="card">

                <div class="card-content center">
                  <h5 class="">Pay As You Go</h5>
                </div>
                <div class="card-content center">

                  <h2>
                    <div class="pricing-price">
                      <small>$</small>0
                    </div>
                    <small class="per-month" style="font-size: 10px;">
                      Per month/user</small>
                  </h2>
                </div>

                <ul class="collection center">
                  <li class="collection-item">
                    <strong>Metered</strong> minutes outbound in the US or Canada 
                  </li>
                  <li class="collection-item">
                    <strong>5</strong> Extensions
                  </li>
                  <li class="collection-item">
                    <strong>1GB</strong> Voicemail
                  </li>
                  <li class="collection-item">
                    <strong>Metered</strong> inbound calling
                  </li>

                  <li class="collection-item">
                    <strong>100</strong> Fax per month
                  </li>

                  <li class="collection-item item-plus">
                    Plus:
                  </li>

                  <li class="collection-item">
                    Unlimited calling between extensions
                  </li>
                  <li class="collection-item">
                    Standard Call Features
                  </li>
                </ul>

                <div class="card-content center card-button">
                  <div>
                    <div class="col-s12">
                      <a href="https://app.lineblocs.com/#/register?plan=go"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class=" col-s12 col-md-3">
              <div class="card">

                <div class="card-content center">
                  <h5 class="">Starter</h5>
                </div>
                <div class="card-content center">
                  <h2>
                    <div class="pricing-price">
                      <small>$</small>
                      24<span class="pricing-decimals">.99</span>
                    </div>
                    <small class="per-month" style="font-size: 10px;">Per month/user</small>
                  </h2>
                </div>
                <ul class="collection center">
                  <li class="collection-item">
                    <strong>200</strong> minutes outbound free minutes per month in the US or Canada
                  </li>
                  <li class="collection-item">
                    <strong>5</strong> Extensions
                  </li>
                  <li class="collection-item">
                    <strong>1GB</strong> Voicemail
                  </li>
                  <li class="collection-item">
                    Mastered inbound calling
                  </li>
                  <li class="collection-item">
                    <strong>100</strong> Fax per month
                  </li>

                  <li class="collection-item item-plus">
                    <span>pay as you go</span> Plus:
                  </li>

                  <li class="collection-item">
                    IM Integrations (slack)
                  </li>
                  <li class="collection-item">
                    Productivity integrations (gsuite, office 365)
                  </li>
                </ul>

                <div class="card-content center card-button">
                  <div>
                    <div class="col-s12">
                      <a href="https://app.lineblocs.com/#/register?plan=starter"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class=" col-s12 col-md-3">
              <div class="card card-popular">
                <div class="card-popular-corner">

                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.4881 7.02719C21.3224 6.87791 21.0863 6.83568 20.8792 6.91829L15.0592 9.23807L9.84877 5.75896C9.66332 5.6351 9.4236 5.62731 9.23047 5.73881C9.03731 5.85034 8.92423 6.06181 8.93874 6.28437L9.3464 12.5364L4.42755 16.4166C4.25247 16.5547 4.17094 16.7803 4.21732 16.9984C4.26369 17.2166 4.42991 17.3895 4.64607 17.4445L10.7179 18.9887L12.8884 24.8659C12.9656 25.0752 13.1549 25.2223 13.3768 25.2457C13.5022 25.2588 13.6258 25.2311 13.731 25.1703C13.8118 25.1237 13.8817 25.0576 13.9334 24.9758L17.2782 19.678L23.5384 19.4303C23.7613 19.4214 23.9598 19.2869 24.0505 19.0831C24.1412 18.8794 24.1084 18.6418 23.9659 18.4702L19.961 13.6521L21.66 7.62143C21.7205 7.40681 21.6539 7.17639 21.4881 7.02719Z" fill="white"></path>
                  </svg>

                  <p>
                    most popular
                  </p>
                </div>

                <div class="card-content center">
                  <h5 class="">Pro</h5>
                </div>
                <div class="card-content center">
                  <h2>
                    <div class="pricing-price">
                      <small>$</small>49<span class="pricing-decimals">.99</span>
                    </div>
                    <small class="per-month" style="font-size: 10px;">Per month/user</small>
                  </h2>
                </div>

                <ul class="collection center">
                  <li class="collection-item">
                    <strong>250</strong> minutes outbound free minutes per month in the US or Canada
                  </li>
                  <li class="collection-item">
                    <strong>5</strong> Extensions
                  </li>
                  <li class="collection-item">
                    <strong>1GB</strong> Voicemail
                  </li>
                  <li class="collection-item">
                    Mastered inbound calling
                  </li>
                  <li class="collection-item">
                    <strong>100</strong> Fax per month
                  </li>

                  <li class="collection-item item-plus">
                    <span>Starter</span> Plus:
                  </li>

                  <li class="collection-item">
                    Productivity Integrations (gsuite, office 365)
                  </li>
                  <li class="collection-item">
                    Voice Analytics
                  </li>
                  <li class="collection-item">
                    Fraud Protection
                  </li>
                  <li class="collection-item">
                    CRM Integrations (salesforce, zoho, zendesk)
                  </li>
                  <li class="collection-item">
                    Programmable developer apps toolkit
                  </li>
                  <li class="collection-item">
                    Okta SSO
                  </li>
                  <li class="collection-item">
                    Phone Provisioner
                  </li>
                  <li class="collection-item">
                    Lineblocs VPN
                  </li>
                  <li class="collection-item">
                    Multiple SIP domains
                  </li>
                  <li class="collection-item">
                    Bring Your Carrier
                  </li>
                </ul>
                <div class="card-content center card-button">
                  <div>
                    <div class="col-s12">
                      <a href="https://app.lineblocs.com/#/register?plan=pro"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class=" col-s12 col-md-3">
              <div class="card">

                <div class="card-content center">
                  <h5 class="">Ultimate</h5>
                </div>
                <div class="card-content center">
                  <h2>
                    <div class="pricing-price">
                      <small>$</small>69<span class="pricing-decimals">.99</span>
                    </div>
                    <small class="per-month" style="font-size: 10px;">Per month/user</small>
                  </h2>
                </div>

                <ul class="collection center">
                  <li class="collection-item">
                    <strong>500</strong> minutes outbound free minutes per month in the US or Canada
                  </li>
                  <li class="collection-item">
                    <strong>5</strong> Extensions
                  </li>
                  <li class="collection-item">
                    <strong>1GB</strong> Voicemail
                  </li>
                  <li class="collection-item">
                    Masterered inbound calling
                  </li>
                  <li class="collection-item">
                    <strong>100</strong> Fax per month
                  </li>

                  <li class="collection-item item-plus">
                    <span>Pro</span> Plus:
                  </li>

                  <p class="collection-item">
                    24 / 7 Support
                  </p>
                  <p class="collection-item">
                    AI based call routing
                  </p>
                </ul>



                <div class="card-content center card-button">
                  <div class="">
                    <div class="col-s12">
                      <a href="https://app.lineblocs.com/#/register?plan=ultimate"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

    </section></div>
    

    <section class="pricing-comparison">
      <div class="container">
        <header>
          <h3 class="hdg">Full plan comparison</h3>
        </header>

        <table class="pricing-table">
          <tbody><tr>
            <td class="pricing-table-spacer">Compare plans</td>
            <th>pay as you go</th>
            <th>starter</th>
            <th>pro</th>
            <th>unlimited</th>
          </tr>
          <tr>
            <td>Minutes outbound in US or Canada</td>
            <td>Metered</td>
            <td><strong>200</strong> Minutes</td>
            <td><strong>250</strong> Minutes</td>
            <td><strong>500</strong> Minutes</td>
          </tr>
          <tr>
            <td>Extensions</td>
            <td>5</td>
            <td>5</td>
            <td>25</td>
            <td>100</td>
          </tr>
          <tr>
            <td>Voicemail</td>
            <td>1GB</td>
            <td>2GB</td>
            <td>32GB</td>
            <td>128GB</td>
          </tr>
          <tr>
            <td>Inbound calling</td>
            <td>Metered</td>
            <td></td>
            <td><svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.7863 2.21369C28.3381 0.7655 26.3372 0 24 0C19.2269 0 16.9125 3.92875 14.8704 7.395C12.9406 10.6709 11.2739 13.5 8 13.5C4.6075 13.5 2.5 11.3925 2.5 8C2.5 4.6075 4.6075 2.5 8 2.5C9.45062 2.5 10.7623 3.08138 12.01 4.27738C12.5084 4.75506 13.2996 4.73844 13.7774 4.24C14.2551 3.74162 14.2384 2.95037 13.74 2.47262C12.0284 0.831937 10.0972 0 8 0C5.66281 0 3.66194 0.7655 2.21369 2.21369C0.7655 3.66194 0 5.66281 0 8C0 10.3372 0.7655 12.3381 2.21369 13.7863C3.66194 15.2345 5.66281 16 8 16C11.8439 16 14.0798 13.3961 15.8744 10.5672C16.1656 11.0612 16.519 11.6007 16.938 12.141C18.8957 14.6656 21.3377 16 24 16C24.9189 16 25.7973 15.8791 26.6104 15.6406C27.2729 15.4464 27.6525 14.7519 27.4583 14.0894C27.264 13.4269 26.5695 13.0474 25.9071 13.2416C25.3224 13.4131 24.6807 13.5 24 13.5C20.2115 13.5 18.0333 9.47887 17.3822 8.05812C19.1867 5.01519 20.8619 2.5 24 2.5C27.3925 2.5 29.5 4.6075 29.5 8C29.5 8.76313 29.3933 9.472 29.1831 10.1069C28.966 10.7622 29.3213 11.4695 29.9766 11.6866C30.6321 11.9037 31.3391 11.5483 31.5562 10.8931C31.8507 10.0041 32 9.03075 32 8C32 5.66275 31.2345 3.66194 29.7863 2.21369Z" fill="url(#paint0_linear)"></path>
                <defs>
                  <linearGradient id="paint0_linear" x1="0" y1="8" x2="32" y2="8" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00F2FE"></stop>
                    <stop offset="0.021" stop-color="#03EFFE"></stop>
                    <stop offset="0.293" stop-color="#24D2FE"></stop>
                    <stop offset="0.554" stop-color="#3CBDFE"></stop>
                    <stop offset="0.796" stop-color="#4AB0FE"></stop>
                    <stop offset="1" stop-color="#4FACFE"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </td>
            <td><svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.7863 2.21369C28.3381 0.7655 26.3372 0 24 0C19.2269 0 16.9125 3.92875 14.8704 7.395C12.9406 10.6709 11.2739 13.5 8 13.5C4.6075 13.5 2.5 11.3925 2.5 8C2.5 4.6075 4.6075 2.5 8 2.5C9.45062 2.5 10.7623 3.08138 12.01 4.27738C12.5084 4.75506 13.2996 4.73844 13.7774 4.24C14.2551 3.74162 14.2384 2.95037 13.74 2.47262C12.0284 0.831937 10.0972 0 8 0C5.66281 0 3.66194 0.7655 2.21369 2.21369C0.7655 3.66194 0 5.66281 0 8C0 10.3372 0.7655 12.3381 2.21369 13.7863C3.66194 15.2345 5.66281 16 8 16C11.8439 16 14.0798 13.3961 15.8744 10.5672C16.1656 11.0612 16.519 11.6007 16.938 12.141C18.8957 14.6656 21.3377 16 24 16C24.9189 16 25.7973 15.8791 26.6104 15.6406C27.2729 15.4464 27.6525 14.7519 27.4583 14.0894C27.264 13.4269 26.5695 13.0474 25.9071 13.2416C25.3224 13.4131 24.6807 13.5 24 13.5C20.2115 13.5 18.0333 9.47887 17.3822 8.05812C19.1867 5.01519 20.8619 2.5 24 2.5C27.3925 2.5 29.5 4.6075 29.5 8C29.5 8.76313 29.3933 9.472 29.1831 10.1069C28.966 10.7622 29.3213 11.4695 29.9766 11.6866C30.6321 11.9037 31.3391 11.5483 31.5562 10.8931C31.8507 10.0041 32 9.03075 32 8C32 5.66275 31.2345 3.66194 29.7863 2.21369Z" fill="url(#paint0_linear)"></path>
                <defs>
                  <linearGradient id="paint0_linear" x1="0" y1="8" x2="32" y2="8" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00F2FE"></stop>
                    <stop offset="0.021" stop-color="#03EFFE"></stop>
                    <stop offset="0.293" stop-color="#24D2FE"></stop>
                    <stop offset="0.554" stop-color="#3CBDFE"></stop>
                    <stop offset="0.796" stop-color="#4AB0FE"></stop>
                    <stop offset="1" stop-color="#4FACFE"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Fax per month</td>
            <td>100</td>
            <td><svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.7863 2.21369C28.3381 0.7655 26.3372 0 24 0C19.2269 0 16.9125 3.92875 14.8704 7.395C12.9406 10.6709 11.2739 13.5 8 13.5C4.6075 13.5 2.5 11.3925 2.5 8C2.5 4.6075 4.6075 2.5 8 2.5C9.45062 2.5 10.7623 3.08138 12.01 4.27738C12.5084 4.75506 13.2996 4.73844 13.7774 4.24C14.2551 3.74162 14.2384 2.95037 13.74 2.47262C12.0284 0.831937 10.0972 0 8 0C5.66281 0 3.66194 0.7655 2.21369 2.21369C0.7655 3.66194 0 5.66281 0 8C0 10.3372 0.7655 12.3381 2.21369 13.7863C3.66194 15.2345 5.66281 16 8 16C11.8439 16 14.0798 13.3961 15.8744 10.5672C16.1656 11.0612 16.519 11.6007 16.938 12.141C18.8957 14.6656 21.3377 16 24 16C24.9189 16 25.7973 15.8791 26.6104 15.6406C27.2729 15.4464 27.6525 14.7519 27.4583 14.0894C27.264 13.4269 26.5695 13.0474 25.9071 13.2416C25.3224 13.4131 24.6807 13.5 24 13.5C20.2115 13.5 18.0333 9.47887 17.3822 8.05812C19.1867 5.01519 20.8619 2.5 24 2.5C27.3925 2.5 29.5 4.6075 29.5 8C29.5 8.76313 29.3933 9.472 29.1831 10.1069C28.966 10.7622 29.3213 11.4695 29.9766 11.6866C30.6321 11.9037 31.3391 11.5483 31.5562 10.8931C31.8507 10.0041 32 9.03075 32 8C32 5.66275 31.2345 3.66194 29.7863 2.21369Z" fill="url(#paint0_linear)"></path>
                <defs>
                  <linearGradient id="paint0_linear" x1="0" y1="8" x2="32" y2="8" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00F2FE"></stop>
                    <stop offset="0.021" stop-color="#03EFFE"></stop>
                    <stop offset="0.293" stop-color="#24D2FE"></stop>
                    <stop offset="0.554" stop-color="#3CBDFE"></stop>
                    <stop offset="0.796" stop-color="#4AB0FE"></stop>
                    <stop offset="1" stop-color="#4FACFE"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </td>
            <td><svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.7863 2.21369C28.3381 0.7655 26.3372 0 24 0C19.2269 0 16.9125 3.92875 14.8704 7.395C12.9406 10.6709 11.2739 13.5 8 13.5C4.6075 13.5 2.5 11.3925 2.5 8C2.5 4.6075 4.6075 2.5 8 2.5C9.45062 2.5 10.7623 3.08138 12.01 4.27738C12.5084 4.75506 13.2996 4.73844 13.7774 4.24C14.2551 3.74162 14.2384 2.95037 13.74 2.47262C12.0284 0.831937 10.0972 0 8 0C5.66281 0 3.66194 0.7655 2.21369 2.21369C0.7655 3.66194 0 5.66281 0 8C0 10.3372 0.7655 12.3381 2.21369 13.7863C3.66194 15.2345 5.66281 16 8 16C11.8439 16 14.0798 13.3961 15.8744 10.5672C16.1656 11.0612 16.519 11.6007 16.938 12.141C18.8957 14.6656 21.3377 16 24 16C24.9189 16 25.7973 15.8791 26.6104 15.6406C27.2729 15.4464 27.6525 14.7519 27.4583 14.0894C27.264 13.4269 26.5695 13.0474 25.9071 13.2416C25.3224 13.4131 24.6807 13.5 24 13.5C20.2115 13.5 18.0333 9.47887 17.3822 8.05812C19.1867 5.01519 20.8619 2.5 24 2.5C27.3925 2.5 29.5 4.6075 29.5 8C29.5 8.76313 29.3933 9.472 29.1831 10.1069C28.966 10.7622 29.3213 11.4695 29.9766 11.6866C30.6321 11.9037 31.3391 11.5483 31.5562 10.8931C31.8507 10.0041 32 9.03075 32 8C32 5.66275 31.2345 3.66194 29.7863 2.21369Z" fill="url(#paint0_linear)"></path>
                <defs>
                  <linearGradient id="paint0_linear" x1="0" y1="8" x2="32" y2="8" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00F2FE"></stop>
                    <stop offset="0.021" stop-color="#03EFFE"></stop>
                    <stop offset="0.293" stop-color="#24D2FE"></stop>
                    <stop offset="0.554" stop-color="#3CBDFE"></stop>
                    <stop offset="0.796" stop-color="#4AB0FE"></stop>
                    <stop offset="1" stop-color="#4FACFE"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </td>
            <td><svg width="32" height="16" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.7863 2.21369C28.3381 0.7655 26.3372 0 24 0C19.2269 0 16.9125 3.92875 14.8704 7.395C12.9406 10.6709 11.2739 13.5 8 13.5C4.6075 13.5 2.5 11.3925 2.5 8C2.5 4.6075 4.6075 2.5 8 2.5C9.45062 2.5 10.7623 3.08138 12.01 4.27738C12.5084 4.75506 13.2996 4.73844 13.7774 4.24C14.2551 3.74162 14.2384 2.95037 13.74 2.47262C12.0284 0.831937 10.0972 0 8 0C5.66281 0 3.66194 0.7655 2.21369 2.21369C0.7655 3.66194 0 5.66281 0 8C0 10.3372 0.7655 12.3381 2.21369 13.7863C3.66194 15.2345 5.66281 16 8 16C11.8439 16 14.0798 13.3961 15.8744 10.5672C16.1656 11.0612 16.519 11.6007 16.938 12.141C18.8957 14.6656 21.3377 16 24 16C24.9189 16 25.7973 15.8791 26.6104 15.6406C27.2729 15.4464 27.6525 14.7519 27.4583 14.0894C27.264 13.4269 26.5695 13.0474 25.9071 13.2416C25.3224 13.4131 24.6807 13.5 24 13.5C20.2115 13.5 18.0333 9.47887 17.3822 8.05812C19.1867 5.01519 20.8619 2.5 24 2.5C27.3925 2.5 29.5 4.6075 29.5 8C29.5 8.76313 29.3933 9.472 29.1831 10.1069C28.966 10.7622 29.3213 11.4695 29.9766 11.6866C30.6321 11.9037 31.3391 11.5483 31.5562 10.8931C31.8507 10.0041 32 9.03075 32 8C32 5.66275 31.2345 3.66194 29.7863 2.21369Z" fill="url(#paint0_linear)"></path>
                <defs>
                  <linearGradient id="paint0_linear" x1="0" y1="8" x2="32" y2="8" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00F2FE"></stop>
                    <stop offset="0.021" stop-color="#03EFFE"></stop>
                    <stop offset="0.293" stop-color="#24D2FE"></stop>
                    <stop offset="0.554" stop-color="#3CBDFE"></stop>
                    <stop offset="0.796" stop-color="#4AB0FE"></stop>
                    <stop offset="1" stop-color="#4FACFE"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Number Porting</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Unlimited Calling between extensions</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Standard call features</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>voicemail transcription</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>IM integrations</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>

            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Productivity integrations</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>

            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>voice analytics</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Fraud protection</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>CRM Integrations (salesforce, zoho, zendesk)</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Okta SSO</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Phone provisioner</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>lineblocs VPN</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Multiple SIP domains</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>Bring your carrier</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>call center apps</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>24 / Support</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
          <tr>
            <td>AI-based call routing</td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#DFF2F2"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 8.70711C6.90237 8.31658 6.90237 7.68342 7.29289 7.29289C7.68342 6.90237 8.31658 6.90237 8.70711 7.29289L12 10.5858L15.2929 7.29289C15.6834 6.90237 16.3166 6.90237 16.7071 7.29289C17.0976 7.68342 17.0976 8.31658 16.7071 8.70711L13.4142 12L16.7071 15.2929C17.0976 15.6834 17.0976 16.3166 16.7071 16.7071C16.3166 17.0976 15.6834 17.0976 15.2929 16.7071L12 13.4142L8.70711 16.7071C8.31658 17.0976 7.68342 17.0976 7.29289 16.7071C6.90237 16.3166 6.90237 15.6834 7.29289 15.2929L10.5858 12L7.29289 8.70711Z" fill="#CADBDB"></path>
              </svg>
            </td>
            <td>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z" fill="#6AD7FA"></path>
                <path d="M6 12L10 16L18 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </td>
          </tr>
        </tbody></table>
      </div>
    </section>








    <!-- <section class="gray">
      <div class="container">
        <div class="service-content">
          <div class="service-img">
            <img src="images/availability-service.png">
          </div>

          <div class="content">
            <h3 class="content-heading">Fully managed solutions, dedicated pricing</h3>

            <p class="content-para">Get a dedicated pricing solution that allows you to scale your team's UC workflows
              at
              ease.</p>

                    //<a href="/register" class="btn-custom service-btn margin-auto">
                     //   <span></span>
                    //</a>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="pbx-section">
        <div class="container">
          <div class="pbx-content">
            <h3 class="pbx-heading">Competitive UC pricing</h3>
            <p class="pbx-para">Never have to worry about spending too much for your team's call system again. Our
              pricing
              solutions offer a complete solution for calling, fax, and IM – at a competitive price point.</p>

            <a href="/register" class="btn-custom service-btn margin-auto">
              <span>Create Account</span>
            </a>
          </div>
        </div>
      </div>
    </section> -->

    <section class="cards-section">
      <div class="learn_more-section">
        <div class="container">
          <div class="learn_more-content">
            <h3 class="learn_more-heading">Learn More</h3>
            <p class="learn_more-para">Have queries regarding our offerings? Feel free to contact us.</p>

            <a href="/contact" class="btn-custom service-btn margin-auto">
              <span>Contact Us</span>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
    $('select').formSelect();
    var select = $("#countries");
    var form = document.forms['pricing'];
    $(select).change(function () {
      form.submit();
    });
  });
</script>
@endsection