<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timewise - Task Matrix with Edit & Complete</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-cream: #F9F3EA;
            --espresso: #2C221E;
            --card-sand: #F7EFE2;
            --card-inner: #FFFFFF;
            --amber-accent: #E4B381;
            --terracotta: #A66E53;
            --border-subtle: rgba(218, 195, 172, 0.5);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--espresso);
            margin: 0;
            padding: 30px;
            background-image: 
                linear-gradient(to right, rgba(220, 205, 185, 0.15) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(220, 205, 185, 0.15) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .container { max-width: 1350px; margin: 0 auto; }

        .header-section { margin-bottom: 25px; }
        .tag-small { font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; color: var(--terracotta); margin-bottom: 6px; text-transform: uppercase; }
        h1 { font-size: 2.3rem; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -1px; }
        p.subtitle { color: #6C5D53; font-size: 1rem; margin: 0; }

        /* Form Card */
        .form-card {
            background-color: #EEDCC5; /* Darker, richer warm sand tone */
            padding: 22px;
            border-radius: 16px;
            margin-bottom: 25px;
            border: 2px solid #D4B293; /* Stronger border for high contrast */
            box-shadow: 0 10px 25px rgba(44, 34, 30, 0.08); /* Slightly deeper shadow */
        }
        
        .form-row { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 12px; margin-bottom: 12px; }
        .form-row-bottom { display: grid; grid-template-columns: 3fr 1fr 1fr auto; gap: 12px; }
        input, select, textarea {
            padding: 10px 14px; border-radius: 10px; border: 1px solid var(--amber-accent);
            background: #fff; font-family: inherit; font-size: 0.9rem; color: var(--espresso);
        }
        textarea { resize: none; height: 38px; }
        .btn-submit {
            background-color: var(--espresso); color: #fff; padding: 10px 20px;
            border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: background 0.2s;
        }
        .btn-submit:hover { background-color: var(--terracotta); }

        /* Main Layout */
        .main-layout { display: grid; grid-template-columns: 2.3fr 1fr; gap: 25px; align-items: start; }

        .matrix-wrapper {
            background-color: var(--card-sand); border-radius: 24px; padding: 25px;
            border: 1px solid var(--border-subtle); box-shadow: 0 10px 30px rgba(44, 34, 30, 0.04);
        }
        .matrix-grid { display: grid; grid-template-columns: repeat(3, 1fr); grid-template-rows: repeat(3, minmax(130px, auto)); gap: 12px; }
        .cell {
            background-color: var(--card-inner); border-radius: 14px; padding: 12px;
            border: 1px solid rgba(228, 179, 129, 0.25); display: flex; flex-direction: column; gap: 8px;
            overflow-y: auto; max-height: 180px;
        }
        .cell-label { font-size: 0.65rem; font-weight: 700; color: #B5A497; text-transform: uppercase; }

        /* Task Chip */
        .task-chip {
            background: var(--bg-cream); padding: 8px 12px; border-radius: 10px; font-size: 0.85rem; font-weight: 600;
            border: 1px solid rgba(228, 179, 129, 0.4); display: flex; justify-content: space-between; align-items: center;
            cursor: pointer; transition: all 0.2s ease;
        }
        .task-chip:hover { border-color: var(--terracotta); transform: translateY(-2px); }
        .task-chip.active { border: 2px solid var(--terracotta); background: #F4E2D0; }
        .task-chip.completed { opacity: 0.5; text-decoration: line-through; background: #EAE3D9; }
        
        .difficulty-tag { font-size: 0.65rem; padding: 2px 6px; border-radius: 4px; background: #fff; color: var(--terracotta); font-weight: 700; }

        /* Smart Estimate & Edit Panel */
        .smart-card {
            background-color: var(--espresso); color: #fff; border-radius: 24px; padding: 25px;
            box-shadow: 0 15px 35px rgba(44, 34, 30, 0.2);
        }
        .smart-card h2 { font-size: 1.3rem; font-weight: 700; margin: 0 0 12px 0; }
        .smart-card p { font-size: 0.85rem; color: #D6CCC2; line-height: 1.5; margin-bottom: 15px; }
        
        /* Edit Form inside Smart Card */
        .edit-form input, .edit-form select, .edit-form textarea {
            width: 100%; box-sizing: border-box; margin-bottom: 10px; background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15); color: #fff; font-size: 0.85rem; padding: 8px 12px;
        }
        .edit-form input::placeholder, .edit-form textarea::placeholder { color: #A89B90; }
        .edit-form label { font-size: 0.7rem; color: var(--amber-accent); text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 3px; }
        
        .action-buttons { display: flex; gap: 8px; margin-top: 15px; }
        .btn-update {
            flex: 1; background: linear-gradient(135deg, #E4B381, #C58B65); color: var(--espresso);
            padding: 12px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 0.85rem;
        }
        .btn-complete {
            background: rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 0.85rem;
        }
        .btn-complete:hover { background: rgba(46, 204, 113, 0.3); border-color: #2ecc71; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-section">
            <div class="tag-small">Priority × Difficulty Matrix</div>
            <h1>Not every task costs the same.</h1>
            <p class="subtitle">Click any task to inspect details, mark it as done, or edit its properties.</p>
        </div>

        <!-- Add Task Form -->
        <div class="form-card">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <input type="text" name="title" placeholder="Task title (e.g., Physics problem set)" required>
                    <select name="priority">
                        <option value="High">High Priority</option>
                        <option value="Medium">Medium Priority</option>
                        <option value="Low">Low Priority</option>
                    </select>
                    <select name="difficulty">
                        <option value="Hard">Hard Difficulty</option>
                        <option value="Moderate">Moderate Difficulty</option>
                        <option value="Easy">Easy Difficulty</option>
                    </select>
                    <input type="text" name="location" placeholder="Location (Optional)">
                    <button type="submit" class="btn-submit">+ Add Task</button>
                </div>
                <div class="form-row-bottom">
                    <textarea name="description" placeholder="Description / Notes (Optional)..."></textarea>
                    <input type="datetime-local" name="due_date">
                    <input type="text" name="reminder" placeholder="Reminder (e.g., 1 hr before)">
                    <div style="font-size: 0.8rem; color: #7A6B60; display: flex; align-items: center;">* Optional fields</div>
                </div>
            </form>
        </div>

        <!-- Main Layout -->
        <div class="main-layout">
            
            <!-- Matrix Grid -->
            <div class="matrix-wrapper">
                <div class="matrix-grid">
                    @php
                        $gridCells = [
                            ['High', 'Easy'], ['High', 'Moderate'], ['High', 'Hard'],
                            ['Medium', 'Easy'], ['Medium', 'Moderate'], ['Medium', 'Hard'],
                            ['Low', 'Easy'], ['Low', 'Moderate'], ['Low', 'Hard']
                        ];
                    @endphp

                    @foreach($gridCells as $cellKey)
                        @php 
                            $p = $cellKey[0]; $d = $cellKey[1]; 
                            $cellTasks = $tasks->where('priority', $p)->where('difficulty', $d);
                        @endphp
                        <div class="cell">
                            <span class="cell-label">{{ $p }} / {{ $d }}</span>
                            @foreach($cellTasks as $task)
                                <div class="task-chip {{ $task->is_completed ? 'completed' : '' }}" 
                                     onclick="selectTask(this)"
                                     data-id="{{ $task->id }}"
                                     data-title="{{ $task->title }}"
                                     data-desc="{{ $task->description }}"
                                     data-due="{{ $task->due_date }}"
                                     data-reminder="{{ $task->reminder }}"
                                     data-location="{{ $task->location }}"
                                     data-priority="{{ $task->priority }}"
                                     data-difficulty="{{ $task->difficulty }}"
                                     data-completed="{{ $task->is_completed }}">
                                    <span>{{ $task->is_completed ? '✓ ' : '' }}{{ $task->title }}</span>
                                    <span class="difficulty-tag">{{ substr($d, 0, 3) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div style="text-align: center; font-size: 0.7rem; font-weight: 700; color: #8C7D73; margin-top: 15px;">
                    EASY &nbsp; ⟶ &nbsp; MODERATE &nbsp; ⟶ &nbsp; HARD (DIFFICULTY)
                </div>
            </div>

            <!-- Inspect & Edit Panel -->
            <div class="smart-card">
                <div style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1.5px; color: var(--amber-accent); text-transform: uppercase; margin-bottom: 6px;">
                    ✨ Inspect & Edit Task
                </div>
                
                <div id="instructionText">
                    <h2>Select a task</h2>
                    <p>Click any task card from your matrix to edit its details or mark it as completed.</p>
                </div>

                <!-- Hidden Edit Form container activated upon clicking a task -->
                <form id="editForm" method="POST" class="edit-form" style="display: none;">
                    @csrf
                    @method('PUT')

                    <label>Task Title</label>
                    <input type="text" name="title" id="editTitle" required>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                        <div>
                            <label>Priority</label>
                            <select name="priority" id="editPriority">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <div>
                            <label>Difficulty</label>
                            <select name="difficulty" id="editDifficulty">
                                <option value="Hard">Hard</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Easy">Easy</option>
                            </select>
                        </div>
                    </div>

                    <label>Description</label>
                    <textarea name="description" id="editDesc"></textarea>

                    <label>Due Date</label>
                    <input type="datetime-local" name="due_date" id="editDue">

                    <label>Location</label>
                    <input type="text" name="location" id="editLocation">

                    <div class="action-buttons">
                        <button type="submit" class="btn-update">Save Changes</button>
                    </div>
                </form>

                <!-- Complete / Uncomplete Toggle Form -->
                <form id="completeForm" method="POST" style="margin-top: 10px; display: none;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-complete" id="completeBtn" style="width: 100%;">
                        ✓ Mark as Done
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function selectTask(element) {
            document.querySelectorAll('.task-chip').forEach(chip => chip.classList.remove('active'));
            element.classList.add('active');

            const id = element.getAttribute('data-id');
            const title = element.getAttribute('data-title');
            const desc = element.getAttribute('data-desc');
            const due = element.getAttribute('data-due');
            const reminder = element.getAttribute('data-reminder');
            const location = element.getAttribute('data-location');
            const priority = element.getAttribute('data-priority');
            const difficulty = element.getAttribute('data-difficulty');
            const completed = element.getAttribute('data-completed') === '1';

            // Hide instruction and show edit interface
            document.getElementById('instructionText').style.display = 'none';
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('completeForm').style.display = 'block';

            // Populate form fields
            document.getElementById('editForm').action = "/tasks/" + id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editPriority').value = priority;
            document.getElementById('editDifficulty').value = difficulty;
            document.getElementById('editDesc').value = desc !== 'null' ? desc : '';
            document.getElementById('editDue').value = due !== 'null' ? due : '';
            document.getElementById('editLocation').value = location !== 'null' ? location : '';

            // Update complete button state
            const completeBtn = document.getElementById('completeBtn');
            document.getElementById('completeForm').action = "/tasks/" + id + "/complete";
            if (completed) {
                completeBtn.innerText = "↩ Mark as Undone";
                completeBtn.style.background = "rgba(231, 76, 60, 0.3)";
            } else {
                completeBtn.innerText = "✓ Mark as Done";
                completeBtn.style.background = "rgba(141, 220, 150, 0.67)";
            }
        }
    </script>

</body>
</html>