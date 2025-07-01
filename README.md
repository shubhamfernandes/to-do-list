# ✅ MLP To-Do List


![Preview](assets/site-layout.png)

---

## 🚀 Features

- 📝 **Create Task** — Add a new task with validation.
- ✅ **Mark Completed** — Toggle task completion with a check icon.
- ❌ **Delete Task** — Remove tasks with a simple delete button.
- 📃 **Pagination** — Paginated task list using custom Blade pagination layout(+10 tasks).
- 🎨 **Responsive Design** — Fully responsive with Bootstrap 5(works on all devices. mobiles included) & Google Fonts.
- 🎭 **Blade Components** — Flash messages and validation errors are handled via reusable components.
- 📦 **Modular Layout** — Layouts and components separated for clarity.
- 🧪 **Tests** — Feature tests added for:
  - Task creation
  - Task deletion
  - Task completion
  - UI validation feedback

---

## 🛠️ Technologies Used

- Laravel 10
- Blade Templates
- Bootstrap 5
- Vite (for asset bundling)
- PHP 8.2+
- Git for version control

---

## 🧑‍💻 Getting Started

### 1. Clone the repo

git clone [https://github.com/YOUR_USERNAME/to-do-list.git](https://github.com/shubhamfernandes/to-do-list)

cd to-do-list

### 2. Install dependencies
composer install

### 3. Setup environment
cp .env.example .env
php artisan key:generate

### 4. Configure database
DB_DATABASE=mlp_todo
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate

### 5. Start the development server
php artisan serve

### 6. Compile CSS/JS using Vite

npm install
npm run dev
