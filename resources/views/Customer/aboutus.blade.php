@extends('layouts.user')
@section('showHeroSection', false)

@section('content')

<div class="wrapper">
    <h1>Our Team Members</h1>
    <div class="our_team">
        <div class="team_member">
            <div class="member_img">
                <img src="{{asset('assets/img/about/Sanjana.jpg')}}" alt="our_team">
            </div>
            <h2>Sanjana A.gunawardana</h2>
            <h3>MAHNDSE231F-008</h3>
            <span>CEO and Backend Developer</span>
           
        </div>
        
        <div class="team_member">
            <div class="member_img">
                <img src="{{asset('assets/img/about/Javindu.JPG')}}" alt="our_team">
            </div>
            <h2>Javindu Gunasekara</h2>
            <h3>MAHNDSE231F-009</h3>
            <span>Accountant</span>
           
        </div>
        
        <div class="team_member">
            <div class="member_img">
                <img src="{{asset('assets/img/about/Nimanthaka--.JPG')}}" alt="our_team">
            </div>
            <h2>Nimanthaka Bashana</h2>
            <h3>MAHNDSE231F-010</h3> 
            <span>Backend Developer</span>
            
        </div>
        
        <div class="team_member">
            <div class="member_img">
                <img src="{{asset('assets/img/about/Tharana.JPG')}}" alt="our_team">
            </div>
            <h2>Tharana Deshan</h2>
            <h3>MAHNDSE231F-007</h3>
           
            <span>Product Analyst</span>
           
        </div>  
    </div>
</div>

@endsection
