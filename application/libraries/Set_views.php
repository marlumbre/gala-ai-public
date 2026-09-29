<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Set_views
{
    // LOGIN

    public function login()
    {
        return 'pages/login';
    }

    // REGISTER

    public function register()
    {
        return 'pages/register';
    }

    // HOME

    public function home()
    {
        return 'pages/index';
    }

    // ABOUT

    public function about()
    {
        return 'pages/about';
    }

    // BLOG

    public function blog()
    {
        return 'pages/blog';
    }

    // BOOKING

    public function booking()
    {
        return 'pages/booking';
    }

    // CONTACT

    public function contact()
    {

        return 'pages/contact';
    }

    // DESTINATION

    public function destination()
    {
        return 'pages/destination';
    }

    // FORM

    public function form()
    {
        return 'pages/form';
    }

    // GALLERY

    public function gallery()
    {
        return 'pages/gallery';
    }

    // GUIDE

    public function guides()
    {
        return 'pages/guides';
    }

    // PACKAGES

    public function packages()
    {
        return 'pages/packages';
    }

    // SERVICES

    public function services()
    {
        return 'pages/services';
    }

    // TESTIMONIAL

    public function testimonial()
    {
        return 'pages/testimonial';
    }

    // TOUR

    public function tour()
    {
        return 'pages/tour';
    }

    // ERROR

    public function not_found()
    {
        return 'pages/404';
    }

    // PROFILE

    public function profile()
    {
        return 'pages/profile';
    }

    public function search()
    {
        return 'pages/search';
    }

    // ADMIN LOG IN
    public function admin_login()
    {
        return 'pages/admin_login';
    }

    // ADMIN DASHBOARD
    public function admin_dashboard()
    {
        return 'pages/admin_dashboard';
    }

    // USERS
    public function admin_users()
    {
        return 'pages/users';
    }

    // OPTION LIST
    public function admin_option_list()
    {
        return 'pages/option_list';
    }

    // HOME DATA
    public function admin_home_data()
    {
        return 'pages/home_data';
    }
}
