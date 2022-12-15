<template>

    <div class="container">
        <div class="screen-container">
            <div class="search-container" v-if="shouldShow === false">
                <div class="item" style="flex: 2;">
                    <img class="svg-icon" @click="test" src="/resources/svg/search.svg" />
                </div>
                <div class="item" style="flex: 10;">
                    <input class="location-search-input" type="text" v-model="userLocation" @focusout="searchLocation"/>
                </div>
            </div>
            <div class="location-container" v-else>
                <h1>{{ location }}</h1>
            </div>
            <div class="weather-container">
                <div class="weather-icon" v-if="shouldShow === true">
                    <img :src="iconUrl"/>
                </div>
                <div class="weather-headline" v-if="shouldShow === true">
                    <h2>{{ weatherHeadline }}</h2>
                </div>
            </div>
            <div class="info-container">
                <div v-if="shouldShow === true" class="section" v-html="temp"/>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from 'vuex';

export default {
    data() {
        return {
            userLocation: '',
        }
    },
    computed: {
        ...mapState([
            'weather',
            'weatherError',
        ]),
        shouldShow() {
            return this.weather !== undefined && this.weatherError === false;
        },
        isError() {
            return this.weatherError === true;
        },
        location() {
          return this.weather.location;
        },
        weatherHeadline() {
            return this.weather.weather_headline;
        },
        weatherDescription() {
            return this.weather.weather_description;
        },
        iconUrl() {
            return this.weather.icon_url;
        },
        temp() {
            console.log()
            return `${this.weather.true_temp}&#8451;`;
        }
    },
    methods: {
        ...mapActions([
           'getWeather',
        ]),
        test() {
            this.$el.querySelector('.location-search-input').focus();
        },
        searchLocation() {
            this.getWeather(this.userLocation);
        },
    },
}
</script>

<style scoped>
/*Move to seperate css*/
div.container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

div.screen-container {
    display: flex;
    flex-direction: column;
    width: 40%;
    height: 60%;
    background-image: linear-gradient(to right top, #000204, #121314, #1d1d1e, #282828, #333333);
    border-radius: 20px;
    border-style: solid;
    border-width: thin;
    border-color: #929292;
}

div.item {
    margin-top: 16px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

div.search-container {
    flex: 2;
    display: flex;
    flex-direction: row;
    padding: 10px;
}

div.location-container {
    flex: 2;
    display: flex;
    padding: 10px;
    justify-content: center;
    align-items: center;
}

div.weather-container {
    flex: 5;
    flex-direction: column;
    display: flex;
    padding: 10px;
    justify-content: center;
    align-items: center;
}

div.weather-icon {
    height: 100%;
    width: 200px;
    flex: 8;
    display: flex;
    padding: 10px;
    justify-content: center;
    align-items: center;
}

div.weather-headline {
    width: 100%;
    flex: 4;
    display: flex;
    padding: 10px;
    justify-content: center;
    align-items: center;
}

div.info-container {
    flex: 5;
    font-size: 50px;
    color: white;
    padding: 10px;
}

div.section {
    flex: 6;
    display: flex;
    justify-content: center;
    align-items: center;
}

.svg-icon {
    width: 24px;
    height: 24px;
}

.location-search {
    height: 32px;
    border-radius: 4px;
}

.location-search-input {
    font-size: 24px;
    width: 80%;
    height: 32px;
    color:white;
    background-color: transparent;
    font-family: Geneva;
}

.location-search-input:focus-visible {
    border: none;
    outline: none;
    -webkit-appearance: none;
    border-bottom: solid;
    border-bottom-color: white;
}

img {
    width: 60%;
}

h1 {
    margin-top: 5px;
    margin-bottom: 5px;
}

h2 {
    margin-top: 5px;
    margin-bottom: 5px;
}

</style>

<style>
/*    TODO: move to separate css*/
    html {
        width: 100%;
        height: 100%;
    }

    body {
        width: 100%;
        height: 100%;
        font-family: Geneva;
        color: white;
        background-image: linear-gradient(to right top, #030303, #050505, #080808, #0a0a0a, #0c0c0c, #0f0f0f, #121212, #151515, #191819, #1c1b1c, #201f1f, #242222);
    }
</style>
