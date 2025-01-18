
# AutoBotics

![AutoBotics](https://s3.us-east-1.amazonaws.com/mejba.me/AI/final-project.png)

A SaaS solution for AI-driven customer service automation using Laravel, Tailwind CSS, and MySQL.

Integrates **Rasa** on local and cloud servers with **Laravel** and custom AI training datasets. Enhances customer experience with intelligent chatbots and multi-language support.

---

## 🚀 Features

- AI-driven customer support using Rasa
- Multi-language support for a global audience
- Laravel backend with seamless database integration
- Responsive UI powered by Tailwind CSS
- Scalable architecture for efficient AI operations
- Easy integration for conversation history storage

---

## 🛠️ Technology Stack

- **Backend:** Laravel Framework
- **Frontend:** Tailwind CSS
- **AI Integration:** Rasa
- **Database:** MySQL
- **Environment:** macOS (local development)

---

## 🔧 Getting Started

### Step 1: Setup Rasa on Local Server

1. Clone the repository:
   ```bash
   git clone https://github.com/mejba13/RasaBot-LocalServer-Setup.git
   cd RasaBot-LocalServer-Setup
   ```

2. Create a Python virtual environment and activate it:
   ```bash
   python3.10 -m venv rasa_env
   source rasa_env/bin/activate
   ```

3. Install Rasa:
   ```bash
   pip install rasa
   ```

4. Initialize and train the Rasa model:
   ```bash
   rasa init --no-prompt
   rasa train
   ```

5. Run the Rasa server locally:
   ```bash
   rasa run --enable-api
   ```

6. (Optional) Run the Rasa action server:
   ```bash
   rasa run actions
   ```

---

### Step 2: Integrate Rasa with Laravel

1. Clone the **AutoBotics** Laravel repository:
   ```bash
   git clone https://github.com/mejba13/AutoBotics.git
   cd AutoBotics
   ```

2. Install Laravel dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure the `.env` file with your environment settings, including the Rasa API endpoint.

4. Run Laravel migrations:
   ```bash
   php artisan migrate
   ```

5. Start the Laravel server:
   ```bash
   php artisan serve
   ```

6. Access the application at `http://127.0.0.1:8000`.

---

## 📂 Project Structure

- **Backend:** `app/Http/Controllers/` contains chat logic
- **Frontend:** Blade templates in `resources/views`
- **Database:** Models and migrations for conversation storage
- **Routes:** API and web routes in `routes/web.php`

---

## 🌟 Enhancements Roadmap

- Real-time AI chat support
- Role-based access control
- Advanced analytics for conversations
- Enhanced AI model training and customization

---

## 🔗 Let's Connect  

- **Instagram**: [engr_mejba_ahmed](https://www.instagram.com/engr_mejba_ahmed/)  
- **TikTok**: [engr_mejba_ahmed](https://www.tiktok.com/@engr_mejba_ahmed)  
- **YouTube**: [Engr Mejba Ahmed](https://www.youtube.com/channel/UCfLIuNxRfXT7HmvvB9Ld0SA)  
- **Twitter**: [@mejba_92](https://x.com/mejba_92)  
- **LinkedIn**: [Engr Mejba Ahmed](https://www.linkedin.com/in/engr-mejba-ahmed-795ab3165/)  
- **Facebook**: [Engr Mejba Ahmed](https://www.facebook.com/engrmejbaahmed/)  
- **Reddit**: [engrmejbaahmed](https://www.reddit.com/user/engrmejbaahmed/)  
- **Pinterest**: [engrmejbaahmed](https://www.pinterest.com/engrmejbaahmed/)  
- **GitLab**: [engr-mejba-ahmed](https://gitlab.com/engr-mejba-ahmed)  
- **LeetCode**: [engrmejbaahmed](https://leetcode.com/u/engrmejbaahmed/)  
- **HackerOne**: [Engr Mejba Ahmed](https://hackerone.com/engrmejbaahmed?type=user)  
- **HackerRank**: [Dashboard](https://www.hackerrank.com/dashboard)  
- **Bugcrowd**: [EngrMejbaAhmed](https://bugcrowd.com/EngrMejbaAhmed)  
- **Medium**: [Engr Mejba Ahmed](https://medium.com/@engr-mejba-ahmed)  
- **TryHackMe**: [EngrMejbaAhmed](https://tryhackme.com/r/p/EngrMejbaAhmed)  
- **Codewars**: [mejba13](https://www.codewars.com/users/mejba13)  
- **GitHub**: [mejba13](https://github.com/mejba13)  
- **PentesterLab**: [lucid_hacker_721](https://pentesterlab.com/profile/lucid_hacker_721)  
- **DEV.to**: [Engr Mejba Ahmed](https://dev.to/engrmejbaahmed)  
- **Quora**: [Engr Mejba Ahmed](https://www.quora.com/profile/Engr-Mejba-Ahmed)  

---

## License

This project is licensed under the MIT License.
