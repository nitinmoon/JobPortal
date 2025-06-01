@extends('frontend.layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Terms and conditions</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Terms and conditions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row text-justify">
                    <p>The following terms and conditions are deemed to have been accepted by the User on usage of the website www.liftale.com. The terms "You" and "User" refer to all individuals and/or entities accessing this site for any reason</p>
                    <h6>GENERAL DISCLAIMER</h6>
                    <p>Every effort has been made to ensure the accuracy of the information. The site is designed, updated and maintained by www.liftale.com. The information contained in this Web site is intended, solely to provide general information for the personal use of the reader, who accepts full responsibility for its use and does not represent or endorse the accuracy or reliability of any information, including content or advertisements contained on, distributed through, or linked, downloaded or accessed from any of the services contained on this web site. The web site may contain inaccuracies, typographical and clerical errors, though efforts had been made to ensure accuracy. But www.liftale.com. reserves the right to change, alter, and delete any of the representations, clauses in this website without prior notice or information.</p>
                    <h6>NO WARRANTIES</h6>
                    <p>www.liftale.com. does not make any warranties, express or implied, including, without limitation, those of merchantability, non-infringement and fitness for a particular purpose, and that the website will operate error free or that the website and its server are free of computer viruses or other harmful mechanisms with respect to any information, data, statements or products made available on the Site and is on a “as is” available basis only.</p>
                    <h6>INDEMNITY</h6>
                    <p>Users agree to indemnify and hold www.liftale.com. and affiliates, officers, agents, co-branders or other partners and employees, harmless from any claim or demand, including reasonable attorneys' fees made by any third party due to the content you submit, post or transmit through the Service, your use of the Service, your connection to the Service, your violation of the Terms and Conditions, or your violation of any rights of another user and any third party claims.</p>
                    <h6>NO LIABILITY</h6>
                    <p>In no event shall www.liftale.com. be liable for any direct, indirect, incidental, disciplinary, or consequential damages of any kind whatsoever with respect to the service, contents as found in this website. You further acknowledge and agree that www.liftale.com., under no circumstances shall be liable for any direct, indirect, incidental, special, exemplary or consequential damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible losses whatsoever.</p>
                    <h6>INTELLECTUAL PROPERTY RIGHTS</h6>
                    <p>All Intellectual property rights are vested solely with www.liftale.com. No part of the webpage/service shall be reproduced or transmitted or stored in any other web site, nor may any of its information or part thereof be disseminated in any electronic or non-electronic form, nor included in any public or private electronic retrieval system or service without obtaining prior written permission from www.liftale.com. Any infringement in this regard shall be adequately compensated by the User .</p>
                    <h6>OTHER TERMS AND CONDITIONS</h6>
                    <p>By using this website, you are indicating your acceptance to abide by the Terms and Conditions which can be updated or modified at any time by www.liftale.com.</p>
                    <p>www.liftale.com. do not disclose any personal information unless specifically requested by the user or required to do so by the law or in good faith that such disclosure is reasonably necessary to: (a) Comply with legal processes (b) Enforce the Terms and Conditions (c) Respond to claims that any content violates the rights of third parties or (d) Protect the rights, property or personal safety of www.liftale.com., its users and the public.</p>
                    <p>www.liftale.com. does not take any responsibility for the acts/omissions on the part of the user(s)/visitor(s)/customer(s) of the site. www.liftale.com. shall not be obliged to resolve or mediate any dispute or difference, which may arise between users/visitors</p>
                    <p>Through this website you may be re - directed to other sites for various purposes and links. www.liftale.com. shall not be liable for any of such sites and their related links.www.liftale.com. shall not be liable if any such links shall directly or indirectly lead to any slander prohibited sites or obscene sites. This site and the intended activities are for the promotion and welfare of the society and does not contribute to any other unauthorized activities.</p>

                    <h6>Right to Reserve:</h6>
                    <p>At our discretion, we reserve the right to suspend or terminate your account and limit or deny any current or future access to Liftale consultancy services, without liability to you. Additionally, Liftale consultancy services retains the exclusive right to modify these Terms at any time, with changes communicated solely through updated postings on the Site and without prior notice.</p>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection
