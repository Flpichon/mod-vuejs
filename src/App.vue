<template>
<div id="app">
  <b-navbar toggleable="lg" type="dark" variant="dark" id ="nav">
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
       <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
        <b-nav-item >Active</b-nav-item>
        <b-nav-item to="/">Home</b-nav-item>
        <b-nav-item to="/about">About</b-nav-item>
        <b-nav-item disabled>Disabled</b-nav-item>
        </b-navbar-nav>
       </b-collapse>
  </b-navbar>
</div>
</template>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
