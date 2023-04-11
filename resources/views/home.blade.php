@extends('layout')



@section('content')

    <section class="row">
        <div class="col-md-6 col-sm-12">
            <div id="with-header" class="card">
                <div class="card-header">
                    <h4 class="card-title">With Header</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body border-top-blue-grey border-top-lighten-5 ">
                        <h4 class="card-title">Content title</h4>
                        <p class="card-text">Add a heading to card with <code>.card-header </code> class &amp; content
                            title uses <code>.card-title</code> class. For border add <code>.border-top-COLOR</code>
                            class</p>
                        <p class="card-text">You may also include any &lt;h1&gt;-&lt;h6&gt; with a
                            <code>.card-header </code> &amp; <code>.card-title</code> class to add heading.</p>
                        <p class="card-text">Jelly beans sugar plum cheesecake cookie oat cake soufflé. Tart lollipop
                            carrot cake sugar plum. Marshmallow wafer tiramisu jelly beans.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
