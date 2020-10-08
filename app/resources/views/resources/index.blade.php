@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
  <!-- heading -->
  <section class="resources">
    <div class="container">
      <div class="resources">
        <!-- section hero -->
        <div class="resources__heading">
          <h1>Resources</h1>
          <p>Everything you need to get the most out of your Lineblocs solution</p>
        </div>

        <!-- section search -->
        <div class="row">
          <form name="search_frm" method="GET" action="" novalidate>
            <div class="relative">
              <div class="input-field col s12">
                <input name="search" type="search" id="autocomplete-input" class="autocomplete" />
                <label for="autocomplete-input">Search Resources</label>
                <!-- <a href="#" class="clear-search">X</a> -->
                <div id="search" class="btn-custom service-btn resource-search">
                  <i class="material-icons">search</i>
                  <span>Search</span>
                </div>
              </div>
            </div>
          </form>

          <!-- resources section -->
          <div class="resource-sections">
            <div class="col s12 l6">
              <div class="resource-card">
                <div class="resource-card__title-column">
                  <svg width="40" height="39" viewBox="0 0 40 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M26.0295 14.0218C27.7217 15.714 30.4654 15.714 32.1577 14.0218C33.8499 12.3295 33.8499 9.58578 32.1577 7.8935C30.4654 6.20123 27.7217 6.20123 26.0295 7.8935C24.3372 9.58578 24.3372 12.3295 26.0295 14.0218ZM27.5616 12.4897C28.4077 13.3358 29.7796 13.3358 30.6257 12.4897C31.4718 11.6436 31.4718 10.2717 30.6257 9.42558C29.7796 8.57945 28.4077 8.57945 27.5616 9.42558C26.7153 10.2717 26.7153 11.6436 27.5616 12.4897Z"
                          fill="#D7D8E1" />
                    <path d="M21.5614 25.6044C21.788 26.1582 22.3977 26.4674 22.9654 26.2783C23.5331 26.0891 23.8429 25.4733 23.6208 24.9178C22.0095 20.8872 19.164 18.0419 15.1333 16.4303C14.5778 16.2082 13.9622 16.5183 13.773 17.0857C13.5838 17.6534 13.893 18.2631 14.4468 18.4897C17.8233 19.8712 20.1799 22.2279 21.5614 25.6044Z"
                          fill="#D7D8E1" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M29.2262 1.22592C32.1629 0.570463 34.9291 0.516123 36.6319 0.571091C38.1993 0.621683 39.4299 1.85241 39.4804 3.41974C39.5354 5.12237 39.4811 7.88866 38.8257 10.8253C38.1718 13.7552 36.9001 16.9399 34.4561 19.3839L34.4078 19.4322C32.4325 21.4076 30.8809 22.9591 29.598 24.07L30.1131 28.7054C30.1859 29.3595 29.9573 30.0112 29.4919 30.4766L24.8933 35.0749C23.7935 36.1749 21.9274 35.7919 21.3495 34.3476L19.2195 29.0223L12.3833 30.1616C10.9168 30.406 9.64548 29.1348 9.88988 27.6682L11.0293 20.8319L5.70395 18.7019C4.25974 18.1242 3.87667 16.2581 4.97656 15.1581L9.57494 10.5597C10.0404 10.0943 10.6921 9.86572 11.3463 9.93839L15.9814 10.4534C17.0925 9.17053 18.6438 7.61908 20.6194 5.64354L20.6675 5.59537C23.1115 3.15137 26.2965 1.87987 29.2262 1.22592ZM29.6981 3.34057C26.9944 3.94407 24.2475 5.0796 22.1995 7.12745C19.928 9.39902 18.3227 11.0061 17.2723 12.2824L16.8994 12.7354L11.107 12.0918L6.50863 16.6901L11.8339 18.8204C12.7793 19.1985 13.3338 20.1839 13.1664 21.1881L12.0271 28.0244L18.8633 26.8851C19.8678 26.7177 20.8532 27.2721 21.2312 28.2176L23.3613 33.5429L27.9596 28.9446L27.3161 23.1522L27.7692 22.7793C29.0455 21.7287 30.6526 20.1234 32.9241 17.8519C34.972 15.8042 36.1076 13.0572 36.711 10.3533C37.3129 7.65633 37.3664 5.08692 37.3151 3.48963C37.3012 3.06408 36.9874 2.75037 36.5619 2.73663C34.9647 2.68506 32.3952 2.73858 29.6981 3.34057Z"
                          fill="#D7D8E1" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M12.0224 38.6621C11.5993 38.2391 11.5993 37.5532 12.0224 37.13L16.6185 32.5339C17.0416 32.1109 17.7276 32.1109 18.1505 32.5339C18.5737 32.957 18.5737 33.643 18.1505 34.0659L13.5544 38.6621C13.1314 39.0852 12.4454 39.0852 12.0224 38.6621Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1.29777 27.9377C0.874703 27.5148 0.874703 26.8288 1.29777 26.4057L5.89396 21.8095C6.31704 21.3866 7.00297 21.3866 7.42603 21.8095C7.84909 22.2327 7.84909 22.9186 7.42603 23.3416L2.82984 27.9377C2.40677 28.3609 1.72083 28.3609 1.29777 27.9377Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M3.59171 36.36C3.16865 35.9371 3.16865 35.2511 3.59171 34.8279L8.1879 30.2318C8.61096 29.8088 9.29689 29.8088 9.71997 30.2318C10.143 30.6549 10.143 31.3409 9.71997 31.7638L5.12378 36.36C4.7007 36.7831 4.01477 36.7831 3.59171 36.36Z"
                          fill="#6AD7FA" />
                  </svg>

                  <h2 class="resource-hdg">Quickstarts</h2>
                </div>
                <ul class="resource-card__description-column">
                  <h2 class="resource-hdg">Quickstarts</h2>
                  <li>
                    <a href="/resources/quickstarts/call-forward">Create a call forwarding</a>
                  </li>
                  <li>
                    <a href="/resources/quickstarts/basic-ivr">Setup a basic 3 option IVR</a>
                  </li>
                  <li>
                    <a href="/resources/quickstarts/recordings-and-voicemail">Add recordings/voicemail</a>
                  </li>
                  <li>
                    <a href="/resources/quickstarts/call-queues">Setup Call Queues</a>
                  </li>
                  <a class="resource-card__view-all" href="/resources/quickstarts">View All</a>
                </ul>
              </div>
            </div>
            <div class="col s12 l6">
              <div class="resource-card">
                <div class="resource-card__title-column">

                  <svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M0.333496 11.0617C0.333496 9.11346 0.973594 7.21035 2.1822 5.36285C2.48021 4.90731 3.10154 4.82097 3.53702 5.14761C3.97252 5.47424 4.05637 6.0899 3.76296 6.54845C2.76861 8.10254 2.30486 9.60369 2.30486 11.0617C2.30486 12.5197 2.76861 14.0209 3.76296 15.5749C4.05637 16.0336 3.97252 16.6492 3.53702 16.9759C3.10154 17.3024 2.48021 17.2162 2.1822 16.7605C0.973594 14.913 0.333496 13.01 0.333496 11.0617Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M4.27637 11.0615C4.27637 9.46274 4.85541 7.58156 6.28617 6.61695C6.73755 6.31265 7.30781 6.60233 7.47995 7.11878C7.65209 7.63522 7.3493 8.20213 6.99984 8.61954C6.54311 9.16506 6.24775 10.0254 6.24773 11.0615C6.24773 12.0977 6.54311 12.958 6.99984 13.5035C7.3493 13.9209 7.65209 14.4878 7.47995 15.0042C7.30783 15.5207 6.73755 15.8104 6.28617 15.506C4.85539 14.5415 4.27637 12.6603 4.27637 11.0615Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M43.6666 11.0617C43.6666 9.11346 43.0265 7.21035 41.818 5.36285C41.5198 4.90731 40.8984 4.82097 40.4629 5.14761C40.0274 5.47424 39.9438 6.0899 40.2372 6.54845C41.2315 8.10254 41.6951 9.60369 41.6951 11.0617C41.6951 12.5197 41.2315 14.0209 40.2372 15.5749C39.9438 16.0336 40.0274 16.6492 40.4629 16.9759C40.8984 17.3024 41.5198 17.2162 41.818 16.7605C43.0265 14.913 43.6666 13.01 43.6666 11.0617Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M39.724 11.0615C39.724 9.46274 39.1451 7.58156 37.7142 6.61695C37.2629 6.31265 36.6926 6.60233 36.5204 7.11878C36.3483 7.63522 36.651 8.20213 37.0005 8.61954C37.4572 9.16506 37.7526 10.0254 37.7526 11.0615C37.7526 12.0977 37.4572 12.958 37.0005 13.5035C36.651 13.9209 36.3483 14.4878 36.5204 15.0042C36.6926 15.5207 37.2629 15.8104 37.7142 15.506C39.1451 14.5415 39.724 12.6603 39.724 11.0615Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M11.167 3.83331C11.167 2.03838 12.6221 0.583313 14.417 0.583313H29.5837C31.3785 0.583313 32.8337 2.03838 32.8337 3.83331V34.1666C32.8337 35.9615 31.3785 37.4166 29.5837 37.4166H14.417C12.6221 37.4166 11.167 35.9615 11.167 34.1666V3.83331ZM14.417 2.74998C13.8187 2.74998 13.3337 3.23501 13.3337 3.83331V34.1666C13.3337 34.7649 13.8187 35.25 14.417 35.25H29.5837C30.1819 35.25 30.667 34.7649 30.667 34.1666V3.83331C30.667 3.23501 30.1819 2.74998 29.5837 2.74998H14.417Z"
                          fill="#D7D8E1" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M17.6669 3.19867L16.9009 2.43265L18.433 0.900574L19.1989 1.66662H24.8015L25.5676 0.900574L27.0997 2.43265L26.3335 3.19867C25.9273 3.60501 25.3761 3.83329 24.8015 3.83329H19.1989C18.6243 3.83329 18.0733 3.60501 17.6669 3.19867Z"
                          fill="#D7D8E1" />
                  </svg>

                  <h2 class="resource-hdg">Managing Numbers</h2>
                </div>
                <ul class="resource-card__description-column">
                  <h2 class="resource-hdg">Managing Numbers</h2>
                  <li>
                    <a href="/resources/managing-numbers/purchase-numbers">Purchasing new numbers</a>
                  </li>
                  <li>
                    <a href="/resources/managing-numbers/manage-numbers">Managing number tags and flows</a>
                  </li>
                  <li>
                    <a href="/resources/managing-numbers/release-numbers">Releasing numbers</a>
                  </li>
                  <li>
                    <a href="/resources/managing-numbers/porting-numbers">Porting Numbers</a>
                  </li>
                  <a class="resource-card__view-all" href="/resources/managing-numbers">View All</a>
                </ul>
              </div>
            </div>
            <div class="col s12 l6">

              <div class="resource-card">
                <div class="resource-card__title-column">

                  <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M46.8002 8.66669H6.50016C5.41683 8.66669 4.3335 9.53335 4.3335 10.8334V41.1667C4.3335 42.25 5.41683 43.3334 6.50016 43.3334H46.8002C47.8835 43.3334 48.9668 42.25 48.9668 41.1667V10.8334C48.9668 9.53335 47.8835 8.66669 46.8002 8.66669ZM46.8002 41.1667H6.50016V10.8334H46.8002V41.1667Z"
                          fill="#D7D8E1" />
                    <path d="M35.967 28.1666C37.1636 28.1666 38.1336 27.1966 38.1336 26C38.1336 24.8034 37.1636 23.8333 35.967 23.8333C34.7703 23.8333 33.8003 24.8034 33.8003 26C33.8003 27.1966 34.7703 28.1666 35.967 28.1666Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M28.1667 22.9666V29.0333C28.1667 30.3333 29.25 31.2 30.3333 31.2H42.6833C43.2816 31.2 43.7667 31.685 43.7667 32.2833C43.7667 32.8816 43.2816 33.3666 42.6833 33.3666H30.3333C27.95 33.3666 26 31.4166 26 29.0333V22.9666C26 20.5833 27.95 18.6333 30.3333 18.6333H42.6833C43.2816 18.6333 43.7667 19.1183 43.7667 19.7166C43.7667 20.3149 43.2816 20.8 42.6833 20.8H30.3333C29.25 20.8 28.1667 21.6666 28.1667 22.9666Z"
                          fill="#6AD7FA" />
                  </svg>

                  <h2 class="resource-hdg">Billing &amp; Pricing</h2>
                </div>
                <ul class="resource-card__description-column">
                  <h2 class="resource-hdg">Billing &amp; Pricing</h2>
                  <li>
                    <a href="/resources/billing-and-pricing/call-pricing">Call pricing</a>
                  </li>
                  <li>
                    <a href="/resources/billing-and-pricing/monthly-invoices">Monthly Invoices</a>
                  </li>
                  <li>
                    <a href="/resources/billing-and-pricing/upgrading-plan">Upgrading Plan</a>
                  </li>
                  <li>
                    <a href="/resources/billing-and-pricing/adding-credit">Adding Credit (Pay As You Go Only)</a>
                  </li>
                  <a class="resource-card__view-all" href="/resources/billing-and-pricing">View All</a>
                </ul>
              </div>
            </div>
            <div class="col s12 l6">

              <div class="resource-card">
                <div class="resource-card__title-column">

                  <svg width="38" height="42" viewBox="0 0 38 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.8332 11.25C30.4314 11.25 30.9165 10.765 30.9165 10.1667C30.9165 9.56841 30.4314 9.08337 29.8332 9.08337H15.7498C15.1516 9.08337 14.6665 9.56841 14.6665 10.1667C14.6665 10.765 15.1516 11.25 15.7498 11.25H29.8332Z"
                          fill="#6AD7FA" />
                    <path d="M30.9165 16.6667C30.9165 17.2649 30.4314 17.75 29.8332 17.75H15.7498C15.1516 17.75 14.6665 17.2649 14.6665 16.6667C14.6665 16.0684 15.1516 15.5834 15.7498 15.5834H29.8332C30.4314 15.5834 30.9165 16.0684 30.9165 16.6667Z"
                          fill="#6AD7FA" />
                    <path d="M24.4165 24.2499C25.0147 24.2499 25.4998 23.7648 25.4998 23.1666C25.4998 22.5684 25.0147 22.0833 24.4165 22.0833H15.7498C15.1516 22.0833 14.6665 22.5684 14.6665 23.1666C14.6665 23.7648 15.1516 24.2499 15.7498 24.2499H24.4165Z"
                          fill="#6AD7FA" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M13.4288 0.107178C10.6999 0.107178 8.44241 2.12504 8.06695 4.75002H6.00016C3.00862 4.75002 0.583496 7.17515 0.583496 10.1667V36.1666C0.583496 39.1581 3.00862 41.5833 6.00016 41.5833H24.4168C27.1457 41.5833 29.4032 39.5655 29.7787 36.9406H32.0002C34.9917 36.9406 37.4168 34.5154 37.4168 31.5239V5.52384C37.4168 2.53231 34.9917 0.107178 32.0002 0.107178H13.4288ZM6.00016 6.91669H8.01209V31.5239C8.01209 34.5154 10.4372 36.9406 13.4288 36.9406H27.5741C27.227 38.3619 25.9452 39.4166 24.4168 39.4166H6.00016C4.20523 39.4166 2.75016 37.9617 2.75016 36.1666V10.1667C2.75016 8.37178 4.20523 6.91669 6.00016 6.91669ZM10.1788 5.52384C10.1788 3.72891 11.6338 2.27384 13.4288 2.27384H32.0002C33.795 2.27384 35.2502 3.72891 35.2502 5.52384V31.5239C35.2502 33.3188 33.795 34.7739 32.0002 34.7739H13.4288C11.6338 34.7739 10.1788 33.3188 10.1788 31.5239V5.52384Z"
                          fill="#D7D8E1" />
                  </svg>

                  <h2 class="resource-hdg">Other Topics</h2>
                </div>
                <ul class="resource-card__description-column">
                  <h2 class="resource-hdg">Other Topics</h2>
                  <li>
                    <a href="/resources/other-topics/learn-trial">Learn about trial balance</a>
                  </li>
                  <li>
                    <a href="/resources/other-topics/account-settings">Account Settings</a>
                  </li>
                  <li>
                    <a href="/resources/other-topics/usage-limits">Usage Limits (Pay-as-you-go only)</a>
                  </li>
                  <li>
                    <a href="/resources/other-topics/setup-usage-triggers">Setup Usage Triggers</a>
                  </li>
                  <a class="resource-card__view-all" href="/resources/other-topics">View All</a>
                </ul>
              </div>
              <div class="col s12">
                <div class="resource-card">
                  <div class="resource-card__title-column">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M27.7997 20C27.7997 24.3078 24.3075 27.8 19.9997 27.8C15.6919 27.8 12.1997 24.3078 12.1997 20C12.1997 15.6923 15.6919 12.2001 19.9997 12.2001C24.3075 12.2001 27.7997 15.6923 27.7997 20ZM25.633 20C25.633 23.1114 23.1108 25.6334 19.9997 25.6334C16.8886 25.6334 14.3664 23.1114 14.3664 20C14.3664 16.8889 16.8886 14.3667 19.9997 14.3667C23.1108 14.3667 25.633 16.8889 25.633 20Z"
                            fill="#6AD7FA" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.7318 1.23493L14.6546 5.42002C14.4379 5.85661 13.9321 6.0661 13.4702 5.91062L9.04347 4.42054C8.71011 4.30833 8.34177 4.36334 8.06377 4.57884C6.76063 5.58896 5.58896 6.76063 4.57884 8.06377C4.36334 8.34177 4.30833 8.71011 4.42054 9.04347L5.91062 13.4702C6.0661 13.9321 5.85661 14.4379 5.42002 14.6546L1.23493 16.7318C0.919705 16.8882 0.698077 17.1877 0.654072 17.5369C0.55239 18.3436 0.5 19.1656 0.5 20C0.5 20.8344 0.55239 21.6564 0.654072 22.4631C0.698077 22.8121 0.919705 23.1118 1.23493 23.2682L5.42002 25.3454C5.85661 25.5621 6.0661 26.068 5.91062 26.5299L4.42054 30.9566C4.30833 31.2899 4.36334 31.6582 4.57884 31.9362C5.58896 33.2394 6.76063 34.4109 8.06377 35.4213C8.34177 35.6366 8.71011 35.6917 9.04347 35.5794L13.4702 34.0894C13.9321 33.9338 14.4379 34.1434 14.6546 34.5799L16.7318 38.7651C16.8882 39.0803 17.1877 39.302 17.5369 39.346C18.3436 39.4476 19.1656 39.5 20 39.5C20.8344 39.5 21.6564 39.4476 22.4631 39.346C22.8121 39.302 23.1118 39.0803 23.2682 38.7651L25.3454 34.5799C25.5621 34.1434 26.068 33.9338 26.5299 34.0894L30.9566 35.5794C31.2899 35.6917 31.6582 35.6366 31.9362 35.4213C33.2394 34.4109 34.4109 33.2394 35.4213 31.9362C35.6366 31.6582 35.6917 31.2899 35.5794 30.9566L34.0894 26.5299C33.9338 26.068 34.1434 25.5621 34.5799 25.3454L38.7651 23.2682C39.0803 23.1118 39.302 22.8121 39.346 22.4631C39.4476 21.6564 39.5 20.8344 39.5 20C39.5 19.1656 39.4476 18.3436 39.346 17.5369C39.302 17.1877 39.0803 16.8882 38.7651 16.7318L34.5799 14.6546C34.1434 14.4379 33.9338 13.9321 34.0894 13.4702L35.5794 9.04347C35.6917 8.71011 35.6366 8.34177 35.4213 8.06377C34.4109 6.76063 33.2394 5.58896 31.9362 4.57884C31.6582 4.36334 31.2899 4.30833 30.9566 4.42054L26.5299 5.91062C26.068 6.0661 25.5621 5.85661 25.3454 5.42002L23.2682 1.23493C23.1118 0.919705 22.8121 0.698077 22.4631 0.654072C21.6564 0.55239 20.8344 0.5 20 0.5C19.1656 0.5 18.3436 0.55239 17.5369 0.654072C17.1877 0.698077 16.8882 0.919705 16.7318 1.23493ZM32.0358 12.779C31.5349 14.2674 32.21 15.8972 33.6166 16.5953L37.261 18.404C37.3089 18.9292 37.3333 19.4614 37.3333 20C37.3333 20.5386 37.3089 21.0708 37.261 21.596L33.6166 23.4047C32.21 24.1028 31.5349 25.7326 32.0358 27.2211L33.3335 31.076C32.6518 31.8959 31.8959 32.6518 31.076 33.3335L27.2211 32.0358C25.7326 31.5349 24.1028 32.21 23.4047 33.6166L21.596 37.261C21.0708 37.3089 20.5386 37.3333 20 37.3333C19.4614 37.3333 18.9292 37.3089 18.404 37.261L16.5953 33.6166C15.8972 32.21 14.2674 31.5349 12.779 32.0358L8.92398 33.3335C8.10422 32.6518 7.34825 31.8959 6.66644 31.076L7.96408 27.2211C8.46508 25.7326 7.79003 24.1028 6.38328 23.4047L2.73901 21.596C2.69117 21.0708 2.66667 20.5386 2.66667 20C2.66667 19.4614 2.69117 18.9292 2.73901 18.404L6.38328 16.5953C7.79003 15.8972 8.46508 14.2674 7.96408 12.779L6.66644 8.92398C7.34825 8.10422 8.10422 7.34825 8.92398 6.66644L12.779 7.96408C14.2674 8.4651 15.8972 7.79003 16.5953 6.38328L18.404 2.73901C18.9292 2.69117 19.4614 2.66667 20 2.66667C20.5386 2.66667 21.0708 2.69117 21.596 2.73901L23.4047 6.38328C24.1028 7.79001 25.7326 8.4651 27.2211 7.96408L31.076 6.66644C31.8959 7.34825 32.6518 8.10422 33.3335 8.92398L32.0358 12.779Z"
                            fill="#D7D8E1" />
                    </svg>

                    <h2 class="resource-hdg">Open Source</h2>
                    <p>
                      how to install and setup the Lineblocs open source edition.
                    </p>
                  </div>
                  <ul class="resource-card__description-column">
                    <h2 class="resource-hdg">Open Source</h2>
                    <li>
                      <a href="/resources/open-source/install-centos8">Installing on CentOS 8</a>
                    </li>
                    <li>
                      <a href="/resources/open-source/creating-trunks">Creating Trunks</a>
                    </li>
                    <li>
                      <a href="/resources/open-source/working-with-routes">Working With Routes</a>
                    </li>
                    <li>
                      <a href="/resources/open-source/setup-extension">Setup Extension</a>
                    </li>
                    <a class="resource-card__view-all" href="/resources/open-source">View All</a>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
  </section>
@endsection
@section ('scripts')
<script>
    var acOptions = {!! json_encode($acOptions) !!};
    var clickedSearch = false;
    function validateForm() {
        var search = $("form[name='search_frm'] input[name='search']").val();
        if (search === "") {
            alert("Please enter a search term");
            return false;
        }
        return true;
    }
    $("form[name='search_frm']").submit(function(event) {
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();
            return;
        }
        if (clickedSearch) {
            return;
        }
        $("form[name='search_frm']").submit();
    });

    $("#search").click(function() {
        console.log("search clicked..");
        if (!validateForm()) {
            return;
        }
        clickedSearch = true;
        $("form[name='search_frm']").submit();
    });
    function clearHideLogic() {
         var val = $( "input[name='search']" ).val();
        if ( val === '' ) {
            $(".clear-search").hide();
        } else {
            $(".clear-search").show();
        }


    }
    $("input[name='search']").on("input",function() {
        clearHideLogic();
    })
    $(".clear-search").click(function() {
        $("input[name='search']").val("");
        clearHideLogic();
    });
  $(document).ready(function(){
  $('input.autocomplete').autocomplete({
    data: acOptions['options'],
    onAutocomplete: function() {
        console.log("auto completed ", this);
//clickedSearch = true;
        //$("form[name='search_frm']").submit();
        var value = this.el.value;
        var link = acOptions['links'][value];
        console.log("link is ", link);
        document.location.href = link;

    }
  });
  setTimeout(function() {
    patchMaterializeInputs();
  }, 0);
});
</script>
@endsection