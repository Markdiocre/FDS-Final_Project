<template>
  <div id="header">
    <div class="container">
      <div class="header-container">
        <router-link to="/LandingPage">
          <img src="../assets/logo.png" alt="Logo" class="logo" />
        </router-link>
        <nav class="navbar">
          <ul id="sidemenu">
            <li><router-link to="/AboutUs">ABOUT US</router-link></li>
            <li><router-link to="/Services">SERVICES</router-link></li>
            <li><router-link to="/OurTeam">OUR TEAM</router-link></li>
            <li><router-link to="/Contacts">CONTACTS</router-link></li>
          </ul>
        </nav>
      </div>

      <div class="header-text">
        <div class="left-side">
          <h1>UNLEASH YOUR</h1>
          <h2>INNER GOD</h2>
          <p>
            Olympus Gym Club is a modern fitness center with top-notch
            equipment, diverse classes, and personalized training to help you
            achieve your health goals in a supportive environment.
          </p>
          <a href="/MainLogin"> <button>LOG IN</button> </a>
        </div>

        <div class="right"></div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@font-face {
  font-family: Grifter;
  src: url("grifterbold.otf");
}

* {
  margin: 0;
  padding: 0;
  font-family: "Figtree";
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

body {
  background: #080808;
  color: #fff;
}

#header {
  width: 100%;
  height: 100vh;
  background-image: url(../assets/background.png);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

.container {
  padding: 10px 10%;
  display: flex;
  flex-direction: column;
}

.header-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  margin-top: 50px;
}

.logo {
  height: 100px;
  margin-right: 450px;
}

.navbar {
  display: flex;
  align-items: center;
}

.navbar ul {
  display: flex;
  list-style-type: none;
  margin: 0;
  padding: 0;
  gap: 20px;
}

.navbar li {
  margin: 30px;
}

.navbar a {
  color: white;
  text-decoration: none;
  font-size: 16px;
  transition: color 0.3s;
}

.navbar a:hover {
  color: #ac0700;
}

.header-text {
  margin-top: 10%;
  margin-bottom: 10%;
  transition: transform 0.3s;
  animation: float 1s;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.left-side {
  flex-basis: 56%;
}

.right {
  flex-basis: 40%;
}

.header-text h1 {
  color: white;
  font-family: "Grifter";
  font-size: 85px;
  margin-bottom: -30px;
}

.header-text h2 {
  color: #ac0700;
  font-size: 15px;
  font-family: "Grifter";
  font-size: 121px;
}

.header-text p {
  margin-top: 1%;
  color: #ded9d9;
  font-family: "Figtree";
  font-size: 20px;
  text-align: justify;
}

@keyframes float {
  from {
    transform: translateY(30px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

button {
  margin-top: 5%;
  color: white;
  font-size: 22px;
  font-family: "Figtree";
  background-color: #ac0700;
  padding: 10px 50px;
  text-align: center;
  font-weight: bold;
  border: 2px solid white;
  border-radius: 40px;
  transition: 0.4s ease;
}
button:hover {
  background-color: #fff;
  color: #313c1c;
}

/* -------------------------------SMALL SCREEN-------------------------------------*/

nav .fa-solid {
  display: none;
}

@media only screen and (max-width: 600px) {
  #header {
    background-image: url(./assets/background-small.jpg);
  }

  .header-text {
    font-size: 16px;
  }

  .header-text h1 {
    font-size: 30px;
  }

  nav .fa-solid {
    display: block;
    font-size: 25px;
  }

  nav ul {
    background: #fbb117;
    position: fixed;
    top: 0;
    right: -200px;
    width: 200px;
    height: 100%;
    padding-top: 50px;
    z-index: 2;
    transition: right 0.5s;
  }

  nav ul li {
    display: block;
    margin: 25px;
  }

  nav ul .fa-solid {
    position: absolute;
    top: 25px;
    left: 25px;
    cursor: pointer;
  }

  .options ul li {
    padding: 10px;
    border-radius: 30px;
    text-align: center;
    list-style: none;
    margin-left: 25px;
    background-color: #fbb117;
  }
}
</style>
