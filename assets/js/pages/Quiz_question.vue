<template>
    <div class="Quiz" >
        <h1 class="Nebula-title desktop">Nebula</h1>
       <div class="Quiz-background"></div>
        <nebu-menu></nebu-menu>
        <div class="Quiz-container">
            <h3 class="Quiz-title">quizz</h3>

            <div class="Quiz-questionContainer">
                <h4 class="Quiz-question" v-if="answers[0]">{{ answers[$route.params.count].Question}}</h4>
            <form method="post">
                <div class="Form-radio" v-if="answers[0]">
                    <p-radio class="p-round p-default Quiz-radio " :class="{'red': red1}" name="radio" value="0" v-model="value">{{answers[$route.params.count].firstAnswer}}</p-radio>
                    <p-radio class="p-round p-default Quiz-radio" :class="{'red': red2}" name="radio" value="1" v-model="value">{{answers[$route.params.count].secondAnswer}}</p-radio>
                    <p-radio class="p-round p-default Quiz-radio" :class="{'red': red3}" name="radio" value="2" v-model="value">{{answers[$route.params.count].thirdAnswer}}</p-radio>
                </div>
                <router-link :to="{path: `/answer/${parseInt($route.params.count)}`}">
                    <input class="Quiz-button" type="submit" value="valider" v-on:click="save"/>
                </router-link>
            </form>
                <div class="kurk"></div>
            </div>
        </div>
            <nebu-footer></nebu-footer >
    </div>
</template>

<script>
    import ElementUI from 'element-ui';
    import nebuFooter from "../components/nebu-footer.vue";
    import nebuMenu from "../components/nebu-menu.vue";
    import DataStore from "../store.js"

    import axios from 'axios';
    export default {
        components: {
            nebuMenu,
            nebuFooter
        },
        name: 'quiz-question',
        data () {
            return {
                value: [],
                answers: {},
                red1: false,
                red2: false,
                red3: false
            };
        },
        mounted () {
            axios
                .get('/api/quizz')
                .then(response => (this.answers = response.data))
        },
        methods : {
            save (){
                DataStore.saveAnswer = DataStore.goodAnswers;
            }
        },
        watch: {
            value: function() {
                if (this.value === '0'  && this.answers[this.$route.params.count].firstAnswerCorrection ) {
                    DataStore.isRightAnswer = true;
                    DataStore.goodAnswers += 1;
                }else if (this.value === '1'  && this.answers[this.$route.params.count].secondAnswerCorrection){
                    DataStore.isRightAnswer = true;
                    DataStore.goodAnswers += 1;
                }else if (this.value === '2'  && this.answers[this.$route.params.count].thirdAnswerCorrection){
                    DataStore.isRightAnswer = true;
                    DataStore.goodAnswers += 1;
                }else{
                    DataStore.isRightAnswer = false;
                    DataStore.goodAnswers = DataStore.saveAnswer;
                }
                if(this.value === '0'){
                    this.red1 = true;
                    this.red2 = false;
                    this.red3 = false;
                }else if(this.value === '1') {
                    this.red1 = false;
                    this.red2 = true;
                    this.red3 = false;
                }else if(this.value === '2'){
                    this.red1 = false;
                    this.red2 = false;
                    this.red3 = true;
                }
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="sass">
.red
    color: #fff
.Quiz
    width: 100%
    height: 100vh
    background: url("../assets/img/quiz_background.jpg") no-repeat
    background-size: cover
    position: relative
    font-family: Roboto, sans-serif
    overflow: hidden
    &-container
        width: 80%
        margin: 0 auto
        text-align: center
    &-title
        font-size: 3.6rem
        font-family: Airship, sans-serif
        color: white
        text-align: left
        margin: 5rem 0 0 0
        text-transform: uppercase
    &-question
        width: 100%
        font-size: 2.0rem
        text-transform: uppercase
        color: #1F0D87
        line-height: 2.4rem
        font-style: italic
        font-weight: 700
        margin-top: 10rem
        margin-bottom: 3rem
        text-align: left
    &-button
        width: 150px
        height: 50px
        font-size: 1.8rem
        line-height: 50px
        background: white
        font-weight: 700
        border-radius: 10px
        text-transform: uppercase
        text-align: center
        margin: 5vh auto
        color: #1F0D87
    &-radio
        width: 100%
        color: #CDC1E1
        font-size: 1.8rem
        margin-bottom: 3rem
        text-align: left
    .desktop
        display: none

@media(min-width: 600px)
    .red
         color: #F13455
    .Quiz
        font-family: Roboto, sans-serif
        position: relative
        height: 100vh
        background: none
        margin: 0 auto
        overflow: hidden
        z-index: 9999

        &-background
            width: 100%
            height: 50vh
            position: absolute
            right: 54px
            bottom: 110px
            background: url("../assets/img/quiz_background_desktop.png") no-repeat
            background-size: 100%
            box-sizing: border-box

        &-container
            width: 100vw
            height: 30vh
            margin: 0 auto
            text-align: center
            padding-top: 0
        &-title
            font-size: 6rem
            font-family: Airship, sans-serif
            color: #231189
            text-align: left
            text-transform: uppercase
            position: absolute
            transform: rotate(90deg)
            right: 0
            top: 180px
        &-question
            font-size: 3.2rem
            color: #FE5B3F
            font-style: italic
            font-weight: 900
            margin-top: 0
            margin-bottom: 1rem
            text-transform: none
        &-button
            width: 150px
            height: 50px
            font-size: 2rem
            line-height: 50px
            background: white
            font-weight: 700
            border-radius: 10px
            border: transparent
            text-transform: uppercase
            text-align: center
            color: #1F0D87
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.1)
            left: 3rem
            position: absolute
            cursor: pointer
            z-index: 1
        &-radio
            width: 100%
            font-size: 2rem
            margin: 1.5rem 0
            text-align: left
        .desktop
            display: block
        .Form-radio
            margin: 4% 0
        .Nebula-title
            font-size: 3rem
            position: absolute
            left: 6rem
            top: 3rem
            font-family: Airship, sans-serif
            color: #F33A56
            z-index: 2
        &-questionContainer
            width: 78%
            height: 45vh
            border-width: 15px
            border-style: solid
            border-image: linear-gradient(348deg, rgba(205, 193, 225, 1) 0%, rgba(243, 58, 86, 1) 100%)
            border-image-slice: 1
            padding: 4rem
            position: relative
            margin: 165px auto
        .kurk
            width: 350px
            height: 300px
            position: absolute
            bottom: 0
            right: 50px
            background: url("../assets/img/kurk.png") no-repeat
            background-size: cover


</style>