<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Tracking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .ticket-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 2rem;
        }
        
        .ticket-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }
        
        .ticket-number {
            color: #6a1b9a;
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .print-icon {
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .print-icon:hover {
            color: #343a40;
        }
        
        .timeline {
            position: relative;
            margin-left: 20px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #6a1b9a;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 25px;
        }
        
        .timeline-dot {
            position: absolute;
            left: 0;
            top: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #6a1b9a;
        }
        
        .timeline-date {
            display: inline-block;
            padding: 4px 10px;
            background-color: #f3e5f5;
            border-radius: 5px;
            font-size: 0.9rem;
            margin-bottom: 5px;
            color: #6a1b9a;
        }
        
        .timeline-status {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 5px 0;
        }
        
        .timeline-admin {
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .status-canceled {
            color: #dc3545;
        }
        
        .status-working {
            color: #fd7e14;
        }
        
        .status-support {
            color: #198754;
        }
        
        .page-title {
            color: #6a1b9a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket-container">
            <div class="ticket-header">
                <h1 class="ticket-number mb-3">Ticket No ({{$data->ticket_no}})</h1>
             
            </div>
            
            <h2 class="page-title mb-4">Ticket Tracking</h2>
            
            <div class="timeline">
                <!-- Item 1 -->
                @foreach ($order_statuses as $order_status)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">
                        {{ \Carbon\Carbon::parse($order_status->created_at)->setTimezone('Asia/Dhaka')->format('d M Y h:i A') }}
                    </div>
                    <div class="timeline-status status-support">
                        {{ $order_status->status }}
                    </div>
                    <div class="timeline-admin">
                        <i class="bi bi-person"></i> {{ $order_status->creator_name }}
                    </div>
                </div>
                @endforeach
                
                {{-- <!-- Item 2 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">
                        02-05-2025 11:09:29
                    </div>
                    <div class="timeline-status status-support">
                        L-4 Support
                    </div>
                    <div class="timeline-admin">
                        <i class="bi bi-person"></i> admin
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">
                        02-05-2025 11:09:24
                    </div>
                    <div class="timeline-status status-canceled">
                        Canceled
                    </div>
                    <div class="timeline-admin">
                        <i class="bi bi-person"></i> admin
                    </div>
                </div>
                
                <!-- Item 4 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">
                        02-05-2025 11:08:12
                    </div>
                    <div class="timeline-status status-working">
                        Working
                    </div>
                    <div class="timeline-admin">
                        <i class="bi bi-person"></i> admin
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>