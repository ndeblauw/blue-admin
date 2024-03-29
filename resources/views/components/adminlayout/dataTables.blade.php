<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<style>                                                                                                                                                                                                                                                                                                                                                                                                                /* Overrides to match the Tailwind CSS */
    table.dataTable tbody td, table.dataTable tbody th {
        padding: 0.75rem 1rem;
    }

    div.dt-buttons {
        padding: 1rem 1rem 1rem 0;
        display: flex;
        align-items: center
    }

    .dataTables_filter, .dataTables_info {
        padding: 1rem
    }

    .dataTables_wrapper .dataTables_paginate {
        padding: 1rem
    }

    .dataTables_filter label input {
        padding: 0.5rem;
        border: 0 solid white!important;
        background-color: white!important;
    }

    .dataTables_filter label input:focus {
        box-shadow: 0 0 0 3px rgba(118, 169, 250, 0.45);
        outline: 0
    }

    table.dataTable thead tr {
        border-radius: 0.5rem
    }

    table.dataTable thead tr th:not(.text-center) {
        text-align: left
    }

    table.dataTable thead tr th {
        border-bottom-width: 2px;
        border-top-width: 1px;
        border-color: #d2d6dc
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.next:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled), button.dt-button {
        transition-duration: 150ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #374151 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        font-size: 0.75rem;
        font-weight: 600;
        align-items: center;
        display: inline-flex;
        border-width: 1px !important;
        border-color: #d2d6dc !important;
        border-radius: 0.375rem;
        background: #ffffff;
        overflow: visible;
        margin-bottom: 0
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled), button.dt-button:focus, button.dt-button:focus:not(.disabled), button.dt-button:hover, button.dt-button:hover:not(.disabled) {
        background-color: #edf2f7 !important;
        border-width: 1px !important;
        border-color: #d2d6dc !important;
        color: #374151 !important
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled) {
        background: #6875f5 !important;
        color: #ffffff !important;
        border-color: #8da2fb !important
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #8da2fb !important;
        color: #ffffff !important;
        border-color: #8da2fb !important
    }

    .dataTables_length select {
        padding: .25rem;
        border-radius: .25rem;
        background-color: #edf2f7;
    }

    .dataTables_length {
        padding-top: 1.25rem;
    }

    .dataTables_wrapper .dataTables_length select {
        width: 58px;
        border:none;
        background-color: white!important;
    }

    table.dataTable tbody tr.odd {
        border-bottom-width: 0px;
        border-top-width: 0px;
        background-color: #f9fafb!important;
    }

    table.dataTable tbody tr.even {
        border-bottom-width: 0px;
        border-top-width: 0px;
        background-color: white;
    }

    table.dataTable tbody tr:hover {
        background-color: rgba(243, 244, 246)!important;
    }

    table {
        border-bottom: none!important;
    }


</style>
