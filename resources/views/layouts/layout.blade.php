<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin: 0;
            padding: 20px;
            background: #4A90E2;
            color: white;
            text-align: center;
        }

        nav {
            background: white;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #4A90E2;
            font-weight: bold;
        }

        nav a:hover {
            color: #1f5fab;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #4A90E2;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0 10px;
        }

        .logout-btn:hover {
            color: #1f5fab;
        }

        .container {
            width: 70%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #4A90E2;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-primary {
            background: #4A90E2;
        }

        .btn-primary:hover {
            background: #1f5fab;
        }

        .btn-success {
            background: #1ABC9C;
        }

        .btn-danger {
            background: #E74C3C;
        }

        .btn-warning {
            background: #F39C12;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            padding: 10px 15px;
            border: none;
            background: #4A90E2;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background: #1f5fab;
        }

    </style>
</head>
<body>

    <h2>Library System</h2>

    <nav>
        @if(auth()->check())

            {{-- ADMIN MENU --}}
            @if(auth()->user()->role === 'admin')

                <a href="/categories">Categories</a>
                <a href="/categories/create">Add Category</a> |

                <a href="/books">Books</a>
                <a href="/books/create">Add Book</a> |

                <a href="{{ route('dashboard') }}">Admin Dashboard</a> |

            @else

            {{-- USER MENU --}}
                <a href="{{ route('user.books') }}">Books</a> |
                <a href="{{ route('user.dashboard') }}">User Dashboard</a> |

            @endif

            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>

        @endif
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>