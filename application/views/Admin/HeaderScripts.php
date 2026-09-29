<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">

<style>
    body {
        background: rgba(19, 53, 123, 1);
    }

    .container {
        margin-top: 20px;
    }

    h2 {
        color: black;
    }

    .metric-icon {
        font-size: 24px;
        margin-right: 10px;
    }

    .date-filter-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .date-filter-form label {
        display: block;
        margin-bottom: 5px;
    }

    .date-filter-form input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .date-filter-form button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .chart-container {
        margin-top: 20px;
        max-width: 600px;
        margin: 20px auto;
    }

    .table-filter-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .date-filter-form {
        max-width: 200px;
        margin-left: auto;
    }

    .date-filter-form input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .date-filter-form button {
        display: block;
        width: 100%;
        padding: 7px;
        background-color: #CD0B0B;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
        opacity: 0.5;
    }

    .title-card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .metrics {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    @media (max-width:940px) {
        .metrics {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    }



    .metric {
        background-color: #f2f2f2f2;
        /* Adjusted to lighter shade for contrast */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        width: 100%;
        max-width: 250px;
        margin: 10px;
        flex-grow: 1;
    }

    .title-card {
        background-color: #fff;
        /* Adjusted to lighter shade for contrast */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 900px;
    }

    .metric-icon {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 10px;
    }

    .metric h3,
    .metric h5 {
        font-size: 1.2rem;
        color: #fff;
        /* Adjust text color for better readability */
    }

    .metric p {
        font-size: 1.5rem;
        color: #fff;
        /* Adjust text color for better readability */

    }

    .mt-queue {
        background-color: #D89216;


    }

    .mt-show {
        background-color: #CD0B0B;

    }

    .mt-served {
        background: rgba(19, 53, 123, 0.8);
    }

    /* Add this to your existing CSS or create a new section */
    .welcome-container {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
    }

    .welcome-header {
        font-size: 28px;
        color: #333;
        /* Adjust text color as needed */
    }

    .welcome-text {
        font-size: 18px;
        color: #555;
        /* Adjust text color as needed */
    }

    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        background-color: #ffffff;
    }

    .container-fluid {
        padding: 0;
    }

    .navbar {
        background: rgba(19, 53, 123, 1);
    }

    .navbar .navbar-nav .nav-item {
        margin-right: 15px;
    }

    .navbar .navbar-nav .nav-item:last-child {
        margin-right: 0;
    }

    .main-container {
        display: flex;
        flex: 1;
        padding: 20px;
    }

    .container {
        margin-top: 50px;
    }

    .form-container {
        background-color: #CD0B0B;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        color: #CD0B0B;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #CD0B0B;
        border: 1px solid #CD0B0B;
    }

    .btn-primary:hover {
        background-color: #3D0000;
        border: 1px solid #3D0000;
    }

    .alert {
        margin-top: 20px;
    }

    .navbar-light .navbar-nav .nav-link,
    .navbar-light .navbar-nav .nav-link:hover {
        color: white;
        /* Set the text color to white */
    }


    .navbar-light .navbar-nav .nav-link i {
        color: white;
        /* Set the icon color to white */
    }

    .navbar-light .navbar-brand {
        color: white;
        /* Set the text color to white */
        font-weight: bold;
        /* Set the font weight to bold */
    }
</style>