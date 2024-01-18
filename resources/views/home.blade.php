@extends('layouts.app')

@section('content')

    {{-- <div class="alert alert-success">
        Login Successfully!
    </div> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <i class="fa fa-check" style="font-size:18px;color:white"></i> Login Successfully!
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 style='text-align: center;'>{{ __('About NAGS (Notify, Administer, General Publication and Scheduling)
                                ') }}</h5>
                            <br> --}}
                            <div class="flex justify-center pt-8 sm:justify-center sm:pt-200">
                                <img src="{{ asset('images/Banner.png') }}" style="padding:0px; margin:0px" width=100% alt=banner height=100%/>
                            </div>

                            <hr>

                            <p class="card-text" style='text-align: justify; text-indent:50px;'>
                                {{-- {{ __('Sample static text page ') }} --}}
                                In today's generation, technology has been a part of people's life. People use technology for learning, 
                                entertainment, and work purposes. Thus, in today's circumstances, technology is constantly a part of everyone's 
                                lives. Everyone uses technology for learning, entertainment, and, most importantly, work. Consequently, the 
                                development of technology has led to a considerable change in how people work and live. As stated by Cascio 
                                and Montealegre (2016), who discuss how technology has revolutionized work and organization, new technologies 
                                have not only helped employees do jobs more quickly and effectively but have also enabled significant changes 
                                in how work is carried out. Numerous studies have found that technology significantly affects various industries, 
                                including business, medicine, education, and the local public sector. The educational sector is one illustration 
                                of a local public sector. Integrating technology into current processes such as enrollment, student records, 
                                grade presentation, and teacher evaluation has proven very beneficial, particularly during pandemics. These IT 
                                solutions were created to help optimize and raise the standard of performance and operations. These advancements 
                                have a big impact and produce good outcomes in educational institutions (Liu, Z., Wang, H., and Zan, H et al., 2010). 
                                Based on the study of Suvin (2019), a student information management system (SIMS) provides several benefits, 
                                including a hassle-free registration procedure, student information administration, student portal construction, 
                                academic counseling, no more data leaks, and even effective communication.  </p>

                            <p class="card-text" style='text-align: justify; text-indent:50px;'> 
                                Aside from academics, schools and universities strive to develop moral and ethical values 
                                in their students. The objective of the guidance office, according to BLIS (n.d.), is to support 
                                students in their academic, personal, social, and emotional growth. The guidance counselor 
                                assesses the student's development and gives the necessary needs to assist the child perform better 
                                as an individual. According to DepEd (2022), more than 28 million pupils have registered for the 
                                school year 2022-2023. With a rising number of students and a limited number of guidance \
                                counselors available in each school or university, monitoring pupils and their behavior had become 
                                a difficult task. Because the office monitors a significant number of students and their records, a 
                                digitalized student record management system is advantageous in making the data much easier to 
                                access and generating a smoother flowing transaction in terms of keeping the record (MasterSoft, n.d.).
                            </p>

                            <p class="card-text" style='text-align: justify; text-indent:50px;'> 
                                According to Gomez (2007)'s research, Filipino guidance workers take on tasks that are not typical of 
                                their supposed job, but that they perform because of their pre-service training and the nature of 
                                their work. According to the study, the majority of professionals do not know their specific job description 
                                since there are services that they believe they are not equipped to perform. They have, however, learned to 
                                perform them on the job. This, in turn, causes work dissatisfaction and discouragement on the part of the 
                                guidance counselor.
                            </p>

                            <p class="card-text" style='text-align: justify; text-indent:50px;'> 
                                The main objective of this study is to design and develop a web-based and mobile-based management system for students, 
                                parents, and administrators that would assist schools manage, monitor, and facilitate faster and more effective work. 
                                The system's purpose is to make the guidance transactions and numerous services available as smooth and simple as possible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection