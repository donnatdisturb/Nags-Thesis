@extends('layouts.post')
@section('content')
    <br>
    <img src="{{ asset('images/TUPTCampusTour.png') }}"
        style=" width: 1295px; display: block;margin-left: auto;margin-right: auto;" />
    <div class="container features">
        <div class="row">
            <video controls alt="School Tour" style="display: block;margin-left: auto;margin-right: auto;">
                <source src="{{ asset('images/SchoolTour.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <br>
    <div class="container p-3 my-3 border">
        <br>
        <h2 class="display-5">TUP Vission</h2>
        <p>TUP: A premier state university with recognized excellence in engineering and technology education at par with
            leading universities in the ASEAN region.</p>
        <hr>

        <h2 class="display-5">TUP Mission</h2>
        <p>The mission of TUP is stated in Section 2 of P.D. No. 1518 as follows:
            The University shall provide higher and advanced vocational, technical, industrial, technological and
            professional education and training in industries and
            technology, and in practical arts leading to certificates, diplomas and degrees. It shall provide progressive
            leadership in applied research, developmental
            studies in technical, industrial, and technological fields and production using indigenous materials; effect
            technology transfer in the countryside; and assist in the development of small-and-medium scale industries in
            identified growth centers.
        </p>
        <hr>

        <h2 class="display-5">TUP Core Values</h2>
        <li> T - Transparent and participatory governance </li>
        <li> U - Unity in the pursuit of TUP mission, goals, and objectives</li>
        <li> P - Professionalism in the discharge of quality service</li>
        <li> I - Integrity and commitment to maintain the good name of the University</li>
        <li> A - Accountability for individual and organizational quality performance</li>
        <li> N - Nationalism through tangible contribution to the rapid economic growth of the country</li>
        <li> N - Nationalism through tangible contribution to the rapid economic growth of the country</li>
        <hr>

        <h2 class="display-5">Strategic Goals</h2>
        <li> Goal 1 - Quality & Responsive Curricular Offerings </li>
        <li> Goal 2 - Excellence in Engineering & Technology Research </li>
        <li> Goal 3 - Leadership in Community Services </li>
        <li> Goal 4 - Strengthening Capability & Competence </li>
        <li> Goal 5 - Modernized University System & Efficient Management of Resources </li>
        <li> Goal 6 - Increased Financial Viability </li>
        <li> Goal 7 - Enhanced Network & Sustained Collaboration Initiatives </li>
        <hr>

        <h2 class="display-5">Quality Process</h2>
        <p>TUP shall commit to provide quality higher and advanced education; conduct relevant research and extension
            projects; continually improve its value to customers through enhancement of personnel competence and effective
            quality management system compliant to statutory and regulatory requirements.</p>
    </div>
@endsection
