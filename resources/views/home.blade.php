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
                            <h5 style='text-align: center;'>{{ __('PASSway: A Digitalized Management System for Student Violation Record
                                ') }}</h5>
                            <br>
                            <div class="flex justify-center pt-8 sm:justify-center sm:pt-200">
                                <img src="{{ asset('images/Banner.png') }}" style="padding:0px; margin:0px" width=100% alt=banner height=100%/>
                            </div>

                            <hr>

                            <p class="card-text" style='text-align: justify; text-indent:50px;'>
                                {{-- {{ __('Sample static text page ') }} --}}
                                In today’s generation, it can be concluded that technology has been a part of people’s life. 
                                People use technology for learning purposes, entertainment purposes and most especially work 
                                purposes. Thus, from today's circumstances technology is constantly a part of everyone’s lives. 
                                Technology is used by everyone for learning, entertainment, and most importantly for work. 
                                Consequently, the development of technology has led to a considerable change in the way people 
                                work and live. As stated by Cascio and Montealegre (2016), who discuss how technology has 
                                revolutionized work and organization, new technologies have not only helped employees do jobs 
                                more quickly and effectively but have also enabled significant changes in how work was carried 
                                out. Numerous studies have found that technology significantly affects a variety of industries, 
                                including business, medical, education, and even local public sector. The educational sector is one 
                                illustration of a local public sector. The integration of technology into current processes such as 
                                enrollment, student records, grade presentation, and teacher evaluation has proven to be very 
                                beneficial, particularly during pandemics. These IT solutions were created to help, optimize, and 
                                raise the standard of performance and operations. These advancements have a big impact and 
                                produce good outcomes in educational institutions (Liu, Z., Wang, H., and Zan, H et al., 2010). 
                                Based on the study of Suvin (2019), a student information management system (SIMS) provides 
                                several benefits, including a hassle-free registration procedure, administration of student information, 
                                construction of a student portal, academic counseling, no more data leaks, and even 
                                effective communication. </p>

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
                                This research aims to design and create a web-based management system for student 
                                violation records that will assist schools and universities in managing their student violation 
                                records more quickly and effectively. This research will use both quantitative and qualitative 
                                method. According to Bhandari (2020), Quantitative method is about collecting numerical data 
                                meanwhile. Qualitative method is about collecting non-numerical data. This study will use a mixed 
                                method, the researchers will be collecting numerical data by the number of violations of each 
                                student. The researchers will also be collecting non-numerical data since the system will also 
                                collect data answering how the system can help the parents, guidance counselor, and the student
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