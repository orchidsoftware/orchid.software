@extends('_layouts.page')
@include('_lang.en')
@section('content')

    <div class="bg-white-only">
        <div class="container">
            <div class="row pt-5 pb-5 container">
                <div class="col-md-12">
                    <div>
                        <h2 class="text-dark font-thin mt-2 mb-2">
                            <svg class="text-muted mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                 width="1em" height="1em" viewBox="0 0 32 32">
                                <path d="M16 0c-8.836 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM20 2.593c4.507 1.343 8.052 4.9 9.397 9.407h-6.486c-0.701-1.204-1.706-2.209-2.91-2.908zM21.989 16.006c0 3.311-2.681 5.994-5.989 5.994s-5.989-2.683-5.989-5.994 2.681-5.994 5.989-5.994c3.307 0 5.989 2.684 5.989 5.994zM14 2.154c0.653-0.094 1.32-0.144 2-0.144s1.346 0.051 2 0.144v6.119c-0.64-0.165-1.308-0.262-2-0.262s-1.36 0.097-2 0.262v-6.119zM12 2.593v6.499c-1.205 0.7-2.21 1.704-2.91 2.908h-6.487c1.345-4.507 4.89-8.063 9.397-9.407zM2.010 16.005c0-0.682 0.058-1.349 0.152-2.005h6.106c-0.166 0.641-0.257 1.312-0.257 2.005 0 0.69 0.091 1.357 0.255 1.995h-6.105c-0.093-0.652-0.151-1.317-0.151-1.995zM12 29.416c-4.511-1.344-8.056-4.906-9.4-9.416h6.483c0.701 1.208 1.708 2.217 2.916 2.919v6.498zM18 29.855c-0.654 0.093-1.321 0.145-2 0.145s-1.347-0.052-2-0.145v-6.118c0.64 0.166 1.308 0.262 2 0.262s1.36-0.097 2-0.262v6.118zM20 29.416v-6.498c1.208-0.701 2.216-1.71 2.916-2.919h6.483c-1.343 4.511-4.89 8.073-9.399 9.416zM23.735 18c0.164-0.637 0.255-1.305 0.255-1.995 0-0.694-0.091-1.364-0.258-2.005h6.107c0.094 0.656 0.152 1.323 0.152 2.005 0 0.678-0.058 1.343-0.151 1.995h-6.105z"></path>
                            </svg>

                            How to do it?
                        </h2>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <p>We did our best to cover all topics related to this product. <br>
                            This section is in addition to <a href="/en/docs">documentation</a> covering popular
                            questions of new users.
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">

                            <!-- TODO:
                            <div class="topics-list">
                                <h3 class="text-black font-thin">
                                    <svg class="text-muted mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                         width="1em" height="1em" viewBox="0 0 32 32">
                                        <path d="M23.845 8.125c-1.395-3.701-4.392-6.045-8.92-6.045-5.762 0-9.793 4.279-10.14 9.861-2.779 0.889-4.784 3.723-4.784 6.933 0 3.93 3.089 7.249 6.744 7.249h0.889c0.552 0 1-0.448 1-1s-0.448-1-1-1h-0.889c-2.572 0-4.776-2.404-4.776-5.249 0-2.515 1.763-4.783 3.974-5.163l0.907-0.156-0.081-0.917-0.008-0.011c0-4.871 3.206-8.545 8.162-8.545 3.972 0 6.204 1.957 7.236 5.295l0.213 0.688 0.721 0.015c3.715 0.078 6.971 3.092 6.971 6.837 0 3.408-2.259 7.206-5.679 7.206h-0.285c-0.552 0-1 0.448-1 1s0.448 1 1 1v-0.003c5-0.132 7.883-4.909 7.883-9.203-0.001-4.617-3.619-8.304-8.141-8.791zM20.198 24.233c-0.279-0.292-0.731-0.292-1.010-0l-2.2 2.427v-10.067c0-0.552-0.448-1-1-1s-1 0.448-1 1v10.076l-2.128-2.373c-0.28-0.292-0.732-0.355-1.011-0.063l-0.252 0.138c-0.28 0.293-0.28 0.765 0 1.057l3.61 3.992c0.005 0.005 0.006 0.012 0.011 0.017l0.253 0.265c0.14 0.146 0.324 0.219 0.509 0.218 0.183 0.001 0.368-0.072 0.507-0.218l0.253-0.265c0.005-0.005 0.008-0.011 0.012-0.017l3.701-4.055c0.279-0.292 0.279-0.639 0-0.932z"></path>
                                    </svg>

                                    Installation
                                </h3>
                                <ul class="list-group pl-5">
                                    <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>

                                    <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                                    <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                                    <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                                </ul>
                            </div>
                            -->
                            <div class="topics-list">
                                <h3 class="text-black font-thin">
                                    <svg class="text-muted mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                         width="1em" height="1em" viewBox="0 0 32 32">
                                        <path d="M30.015 12.97l-2.567-0.569c-0.2-0.64-0.462-1.252-0.762-1.841l1.389-2.313c0.518-0.829 0.78-2.047 0-2.829l-1.415-1.414c-0.78-0.781-2.098-0.64-2.894-0.088l-2.251 1.434c-0.584-0.303-1.195-0.563-1.829-0.768l-0.576-2.598c-0.172-0.953-1.005-1.984-2.11-1.984h-2c-1.104 0-1.781 1.047-2 2l-0.642 2.567c-0.678 0.216-1.328 0.492-1.948 0.819l-2.308-1.47c-0.795-0.552-2.114-0.692-2.894 0.088l-1.415 1.414c-0.781 0.782-0.519 2 0 2.828l1.461 2.435c-0.274 0.552-0.517 1.123-0.705 1.72l-2.566 0.569c-0.953 0.171-1.984 1.005-1.984 2.109v2c0 1.105 1.047 1.782 2 2l2.598 0.649c0.179 0.551 0.404 1.080 0.658 1.593l-1.462 2.438c-0.518 0.828-0.78 2.047 0 2.828l1.415 1.414c0.78 0.782 2.098 0.64 2.894 0.089l2.313-1.474c0.623 0.329 1.277 0.608 1.96 0.823l0.64 2.559c0.219 0.953 0.896 2 2 2h2c1.105 0 1.938-1.032 2.11-1.985l0.577-2.604c0.628-0.203 1.23-0.459 1.808-0.758l2.256 1.438c0.796 0.552 2.114 0.692 2.895-0.089l1.415-1.414c0.78-0.782 0.518-2 0-2.828l-1.39-2.317c0.279-0.549 0.521-1.12 0.716-1.714l2.599-0.649c0.953-0.219 2-0.895 2-2v-2c0-1.104-1.031-1.938-1.985-2.11zM30.001 16.939c-0.085 0.061-0.245 0.145-0.448 0.192l-3.708 0.926-0.344 1.051c-0.155 0.474-0.356 0.954-0.597 1.428l-0.502 0.986 1.959 3.267c0.125 0.2 0.183 0.379 0.201 0.485l-1.316 1.314c-0.127-0.040-0.271-0.092-0.341-0.14l-3.292-2.099-1.023 0.529c-0.493 0.256-0.999 0.468-1.503 0.631l-1.090 0.352-0.824 3.723c-0.038 0.199-0.145 0.36-0.218 0.417h-1.8c-0.061-0.085-0.145-0.245-0.191-0.448l-0.921-3.681-1.066-0.338c-0.549-0.173-1.097-0.404-1.63-0.684l-1.028-0.543-3.293 2.099c-0.135 0.091-0.279 0.143-0.409 0.143l-1.311-1.276c0.018-0.104 0.072-0.274 0.181-0.449l2.045-3.408-0.487-0.98c-0.227-0.462-0.407-0.895-0.547-1.325l-0.343-1.052-3.671-0.918c-0.231-0.052-0.398-0.139-0.485-0.2v-1.86c0.001 0.001 0.002 0.001 0.005 0.001 0.034 0 0.198-0.117 0.335-0.142l3.772-0.835 0.346-1.103c0.141-0.449 0.333-0.917 0.588-1.43l0.487-0.98-2.024-3.373c-0.125-0.201-0.184-0.38-0.201-0.485l1.315-1.314c0.128 0.041 0.271 0.093 0.34 0.14l3.354 2.138 1.027-0.542c0.527-0.278 1.073-0.507 1.622-0.682l1.063-0.338 0.912-3.649c0.053-0.231 0.138-0.398 0.2-0.485h1.859c-0.014 0.020 0.115 0.195 0.142 0.339l0.84 3.794 1.089 0.352c0.511 0.165 1.023 0.38 1.523 0.639l1.023 0.532 3.224-2.053c0.135-0.092 0.279-0.143 0.409-0.143l1.313 1.276c-0.017 0.104-0.072 0.276-0.181 0.45l-1.98 3.296 0.505 0.988c0.273 0.533 0.48 1.033 0.635 1.529l0.346 1.104 3.697 0.82c0.224 0.041 0.398 0.171 0.434 0.241zM16.013 9.99c-3.321 0-6.023 2.697-6.023 6.010s2.702 6.010 6.023 6.010 6.023-2.697 6.023-6.009c0-3.313-2.702-6.010-6.023-6.010zM16 20c-2.205 0-4-1.794-4-4s1.794-4 4-4c2.206 0 4 1.794 4 4s-1.794 4-4 4z"></path>
                                    </svg>
                                    Settings &amp; Configuration
                                </h3>
                                <ul class="list-group pl-5">
                                    <li><a href="/en/recipes/how-to-show-the-admin-panel-on-the-home-page">How to show the admin panel on the home page?</i></a></li>
                                    <li><a href="#">How to change the path of the file upload? <i class="text-muted">(Coming
                                                soon)</i></a></li>
                                </ul>
                            </div>

                            <div class="topics-list">
                                <h3 class="text-black font-thin">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-muted mr-2" width="1em"
                                         height="1em" viewBox="0 0 32 32" role="img" fill="currentColor"
                                    >
                                        <path d="M0.682 9.431l14.847 8.085c0.149 0.081 0.313 0.122 0.479 0.122 0.163 0 0.326-0.040 0.474-0.12l15.003-8.085c0.327-0.176 0.53-0.52 0.525-0.892s-0.216-0.711-0.547-0.88l-14.848-7.54c-0.283-0.143-0.617-0.144-0.902-0.002l-15.002 7.54c-0.332 0.167-0.545 0.505-0.551 0.877s0.196 0.717 0.521 0.895zM16.161 2.134l12.692 6.446-12.843 6.921-12.693-6.912zM31.292 15.010l-2.968-1.507-2.142 1.155 2.5 1.27-12.842 6.921-12.694-6.912 2.666-1.34-2.136-1.164-3.135 1.575c-0.332 0.167-0.545 0.505-0.551 0.877s0.196 0.717 0.521 0.895l14.847 8.085c0.149 0.081 0.313 0.122 0.479 0.122 0.163 0 0.326-0.040 0.474-0.12l15.003-8.085c0.327-0.176 0.53-0.52 0.525-0.892s-0.215-0.711-0.546-0.88zM31.292 22.010l-2.811-1.382-2.142 1.155 2.344 1.145-12.843 6.921-12.694-6.912 2.478-1.121-2.136-1.164-2.947 1.357c-0.332 0.167-0.545 0.505-0.551 0.877s0.196 0.717 0.521 0.895l14.847 8.085c0.149 0.081 0.313 0.122 0.479 0.122 0.163 0 0.326-0.040 0.475-0.12l15.003-8.085c0.327-0.176 0.53-0.52 0.525-0.892-0.005-0.373-0.215-0.712-0.546-0.88z"></path>
                                    </svg>
                                    Layouts &amp; Fields
                                </h3>
                                <ul class="list-group pl-5">
                                    <li><a href="/en/recipes/how-to-re-use-layers">How to re-use layers?</a></li>
                                    <li><a href="/en/recipes/how-to-access-screen-data-from-a-layer">How to access screen data from a layer?</a></li>
                                    <li><a href="/en/recipes/how-to-avoid-duplicate-fields">How to avoid duplicate
                                            fields?</a></li>
                                </ul>
                            </div>

                            <div class="topics-list">
                                <h3 class="text-black font-thin">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-muted mr-2"
                                         width="1em" height="1em" viewBox="0 0 32 32">
                                        <path d="M9,0H1A1,1,0,0,0,0,1V9a1,1,0,0,0,1,1H9a1,1,0,0,0,1-1V1A1,1,0,0,0,9,0ZM8,8H2V2H8Z"></path>
                                        <path d="M20,0H12a1,1,0,0,0-1,1V9a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V1A1,1,0,0,0,20,0ZM19,8H13V2h6Z"></path>
                                        <path d="M31,0H23a1,1,0,0,0-1,1V9a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V1A1,1,0,0,0,31,0ZM30,8H24V2h6Z"></path>
                                        <path d="M9,11H1a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1H9a1,1,0,0,0,1-1V12A1,1,0,0,0,9,11ZM8,19H2V13H8Z"></path>
                                        <path d="M20,11H12a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V12A1,1,0,0,0,20,11Zm-1,8H13V13h6Z"></path>
                                        <path d="M31,11H23a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V12A1,1,0,0,0,31,11Zm-1,8H24V13h6Z"></path>
                                        <path d="M9,22H1a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1H9a1,1,0,0,0,1-1V23A1,1,0,0,0,9,22ZM8,30H2V24H8Z"></path>
                                        <path d="M20,22H12a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V23A1,1,0,0,0,20,22Zm-1,8H13V24h6Z"></path>
                                        <path d="M31,22H23a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V23A1,1,0,0,0,31,22Zm-1,8H24V24h6Z"></path>
                                    </svg>

                                    Table & Columns
                                </h3>
                                <ul class="list-group pl-5">
                                    <li><a href="/en/recipes/changing-the-visual-table">How do change the look of a
                                            table?</a></li>
                                    <li><a href="/en/recipes/how-to-use-sorting-in-a-table">How to use sorting on a
                                            table?</a></li>
                                    <li><a href="/en/recipes/column-expansion">How to re-use the column?</a></li>
                                    <li><a href="/en/recipes/how-to-use-a-field-in-a-table">How to use a field in a
                                            table?</a></li>
                                    <li><a href="/en/recipes/how-to-use-multiple-elements-in-a-column">How to add multiple fields
                                            in a column?</a></li>
                                </ul>
                            </div>

                            <!-- TODO:
                           <div class="topics-list">
                               <h3 class="text-black font-thin">

                                   <svg class="text-muted mr-2" xmlns="http://www.w3.org/2000/svg" width="1em"
                                        height="1em" fill="currentColor" viewBox="0 0 32 32">
                                       <path d="M31.783 5.814l-3.116-3.479c-0.189-0.214-0.462-0.336-0.748-0.336h-10.945v-1.062c0-0.517-0.448-0.938-1-0.938s-1 0.42-1 0.938v1.062h-7.994c-0.553 0-1 0.448-1 1v6.989c0 0.553 0.447 1 1 1h7.994v2.003h-10.893c-0.286 0-0.558 0.122-0.748 0.336l-3.115 3.541c-0.336 0.379-0.336 0.949 0 1.328l3.115 3.509c0.191 0.214 0.462 0.305 0.748 0.305h10.893v9.052c0 0.517 0.448 0.938 1 0.938s1-0.42 1-0.938v-9.053h8.015c0.552 0 1-0.448 1-1v-7.019c0-0.553-0.448-1-1-1h-8.014v-2.003h10.945c0.286 0 0.558-0.122 0.748-0.336l3.116-3.51c0.335-0.378 0.335-0.949 0-1.328v-0zM23.989 20.010h-19.459l-2.228-2.477 2.228-2.541h19.459v5.018zM27.47 8.989h-19.49v-4.989h19.49l2.227 2.479z"></path>
                                   </svg>

                                   Navigation &amp; Messages
                               </h3>
                               <ul class="list-group pl-5">
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>

                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i> </a></li>
                               </ul>
                           </div>
                           -->
                        </div>
                        <div class="col-12 col-md-4">

                            <div class="topics-list">
                                <h3 class="text-black font-thin">

                                    <svg class="text-muted mr-2" xmlns="http://www.w3.org/2000/svg" width="1em"
                                         height="1em" fill="currentColor" viewBox="0 0 32 32">
                                        <path d="M7.11,23.52l1.42-1.41C5.14,18.72,3.37,17,2.39,16L8.53,9.89A1,1,0,1,0,7.11,8.47L.29,15.29A1.05,1.05,0,0,0,0,16a1,1,0,0,0,.3.71Z"></path>
                                        <path d="M31.71,15.29c-.1-.09-6.82-6.82-6.82-6.82L23.48,9.89c3.38,3.38,5.15,5.16,6.13,6.09l-6.13,6.13a1,1,0,0,0,.7,1.71,1,1,0,0,0,.71-.3l6.82-6.81A1,1,0,0,0,32,16,1,1,0,0,0,31.71,15.29Z"></path>
                                        <path d="M13.27,27.91a1,1,0,0,0,1-.76L19.7,5.33a1,1,0,0,0-1.94-.48L12.3,26.67A1,1,0,0,0,13,27.88,1,1,0,0,0,13.27,27.91Z"></path>

                                    </svg>

                                    JavaScript
                                </h3>
                                <ul class="list-group pl-5">
                                    <li><a href="/en/recipes/js-call-on-page-refresh">How to call a script whenever the
                                            page?</a></li>
                                </ul>
                            </div>

                            <!-- TODO:
                           <div class="topics-list">
                               <h3 class="text-black font-thin">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="text-muted mr-2"
                                        preserveAspectRatio="xMidYMid" width="1em" height="1em" viewBox="0 0 32 26"
                                        role="img" fill="currentColor">
                                       <path d="M30.000,21.000 L17.000,21.000 L17.000,24.000 L22.047,24.000 C22.600,24.000 23.047,24.448 23.047,25.000 C23.047,25.552 22.600,26.000 22.047,26.000 L10.047,26.000 C9.494,26.000 9.047,25.552 9.047,25.000 C9.047,24.448 9.494,24.000 10.047,24.000 L15.000,24.000 L15.000,21.000 L2.000,21.000 C0.898,21.000 0.000,20.103 0.000,19.000 L0.000,2.000 C0.000,0.897 0.898,0.000 2.000,0.000 L30.000,0.000 C31.103,0.000 32.000,0.897 32.000,2.000 L32.000,19.000 C32.000,20.103 31.103,21.000 30.000,21.000 ZM2.000,2.000 L2.000,19.000 L29.997,19.000 L30.000,2.000 L2.000,2.000 Z"></path>
                                   </svg>
                                   Screen & Actions
                               </h3>
                               <ul class="list-group pl-5">
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i></a></li>
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i></a></li>
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i></a></li>
                                   <li><a href="#">In the process <i class="text-muted">(Coming soon)</i></a></li>
                               </ul>
                           </div>
                           -->

                        </div>

                        <div class="col-12 col-md-4">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--
        <div class="bg-white">
            <div class="container">
                <!--Row-->
                <div class="row pb-5 pt-5">

                    <div class="col-md-12">
                        <h3 class="font-thin text-black text-center m-b-lg m-t-xl">What's next?</h3>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="m-t-md m-b-md wrapper-lg  b">
                            <div class="ico column text-primary"><i class="icon-energy"></i></div>
                            <div class="desc">
                                <h4 class="font-thin">Tutorials</h4>
                                <p>
                                    Build a simple app in minutes. Master advanced concepts and techniques
                                </p>
                                <p class="text-right">
                                    <a href="#" class="small">Start now <i class="icon-right m-l-xs"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="m-t-md m-b-md wrapper-lg  b">
                            <div class="ico column text-primary"><i class="icon-direction"></i></div>
                            <div class="desc">
                                <h4 class="font-thin">Guide</h4>
                                <p>
                                    The best practices for creating applications based on the ORCHID platform
                                </p>
                                <p class="text-right">
                                    <a href="#" class="small">Read now <i class="icon-right m-l-xs"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="m-t-md m-b-md wrapper-lg  b">
                            <div class="ico column text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path d="M26.536 0h-19.937c-1.438 0-2.063 1.063-2.063 2.063v3.979h-1.091c-0.541 0-0.979 0.439-0.979 0.98s0.438 0.98 0.979 0.98h1.091v4.024h-0.998c-0.541 0-0.98 0.438-0.98 0.979s0.438 0.98 0.979 0.98h0.998v4.045h-1.019c-0.541 0-0.979 0.439-0.979 0.98s0.438 0.98 0.979 0.98h1.019v4.014h-1.019c-0.541 0-0.979 0.439-0.979 0.98s0.438 0.98 0.979 0.98h1.019v4.040c0 1.657 1.298 2 2.016 2h19.985c1.657 0 3-1.343 3-3v-26c0-1.657-1.343-3-3-3zM6.535 30l-0-4.040h1.042c0.541 0 0.979-0.439 0.979-0.98s-0.438-0.98-0.979-0.98h-1.042v-4.014h1.042c0.541 0 0.979-0.439 0.979-0.98s-0.438-0.98-0.979-0.98h-1.042v-4.045h1.063c0.541 0 0.98-0.438 0.98-0.98s-0.438-0.979-0.979-0.979h-1.063v-4.024h0.97c0.541 0 0.979-0.439 0.979-0.979s-0.438-0.98-0.979-0.98h-0.97v-3.978c0-0.023 0.002-0.043 0.005-0.060 0.016-0.001 0.035-0.002 0.059-0.002h15.938v28h-16.001zM27.536 29c0 0.552-0.448 1-1 1h-2v-28h2c0.552 0 1 0.448 1 1v26z"></path>
                                </svg>
                            </div>
                            <div class="desc">
                                <h4 class="font-thin">Documentation</h4>
                                <p>
                                    Reference documentation to discover everything Meteor has to offer
                                </p>
                                <p class="text-right">
                                    <a href="#" class="small">Explore now <i class="icon-right m-l-xs"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End row-->
            </div>
        </div>
    --}}

@endsection
