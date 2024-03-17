<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Departments
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('home');
    $trail->push('Departments', route('departments.index'));
});

// Home > Departments > Add New
Breadcrumbs::for('departments.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Departments', route('departments.index'));
    $trail->push('Add New', route('departments.create'));
});

// Home > Departments > Edit
Breadcrumbs::for('departments.edit', function ($trail, $department) {
    $trail->parent('home');
    $trail->push('Departments', route('departments.index'));
    $trail->push($department->name, route('departments.edit', $department->id));
});

// Home > Employees
Breadcrumbs::for('employees', function ($trail) {
    $trail->parent('home');
    $trail->push('Employees', route('employees.index'));
});

// Home > Employees > Add New
Breadcrumbs::for('employees.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Employees', route('employees.index'));
    $trail->push('Add New', route('employees.create'));
});

// Home > Employees > Edit
Breadcrumbs::for('employees.edit', function ($trail, $employee) {
    $trail->parent('home');
    $trail->push('Employees', route('employees.index'));
    $trail->push($employee->first_name, route('employees.edit', $employee->id));
});

// Home > Tasks
Breadcrumbs::for('tasks', function ($trail) {
    $trail->parent('home');
    $trail->push('Tasks', route('tasks.index'));
});

// Home > Tasks > Add New
Breadcrumbs::for('tasks.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Tasks', route('tasks.index'));
    $trail->push('Add New', route('tasks.create'));
});

// Home > Tasks > Edit
Breadcrumbs::for('tasks.edit', function ($trail, $task) {
    $trail->parent('home');
    $trail->push('Tasks', route('tasks.index'));
    $trail->push($task->name, route('tasks.edit', $task->id));
});
