const jumbotron = document.getElementById('jumbotron')
const loadingScreen = document.getElementById('loadingScreen')
const quizContainer = document.getElementById('quiz')
const errorContainer = document.getElementById('error')
const completedContainer = document.getElementById('completed')

const questionCard = document.querySelector('.card')
const cardHeader = document.querySelector('.card-header')
const cardBody = document.querySelector('.card-body')
const cardFooter = document.querySelector('.card-footer')

const progressText = document.getElementById('progress')

let globalData

let points = 0

async function getQuestions(){
    jumbotron.style.display = 'none'
    let response = await fetch('https://opentdb.com/api.php?amount=20')
    let data = await response.json()
    return data
}

getQuestions()
.then(function(data){
    globalData = data
    jumbotron.style.display = 'block'
    loadingScreen.style.display = 'none'
    console.log(globalData)
    handleRouter()
})

document.getElementById('startQuiz').addEventListener('click', function(e){
    e.preventDefault()
    location.hash = 'question-1'
})

window.addEventListener('hashchange', handleRouter)

document.getElementById('startOver').addEventListener('click', function(e){
    e.preventDefault()
    tryAgain()
})
document.getElementById('tryAgain').addEventListener('click', function(e){
    e.preventDefault()
    tryAgain()
})


function handleRouter(){
    if(!location.hash || location.hash === '#'){
        quizContainer.style.display = 'none'
        errorContainer.style.display = 'none'
        completedContainer.style.display = 'none'
    } else if(location.hash.match(/^#question-(?:[1-9]|1[0-9]|20)$/)) {
        quizContainer.style.display = 'block'
        jumbotron.style.display = 'none'
        errorContainer.style.display = 'none'
        completedContainer.style.display = 'none'
        handleQuestion(globalData)
        handleProgress()
    } else if (location.hash === '#completed'){
        quizContainer.style.display = 'none'
        jumbotron.style.display = 'none'
        errorContainer.style.display = 'none'
        completedContainer.style.display = 'block'
        handleCompletedQuiz()
    } else {
        errorContainer.style.display = 'block'
        jumbotron.style.display = 'none'
        quizContainer.style.display = 'none'
        completedContainer.style.display = 'none'
    }
}

function shuffleArray(array){
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function handleQuestion(data){
    let questionNumber = parseInt(location.hash.split('-')[1])

    cardHeader.innerHTML = ''
    cardBody.innerHTML = ''
    cardFooter.innerHTML = ''

    const question = document.createElement('h4')
    question.innerHTML = data.results[questionNumber - 1].question
    cardHeader.appendChild(question)

    const answers = shuffleArray([
        data.results[questionNumber - 1].correct_answer,
        ...data.results[questionNumber - 1].incorrect_answers
    ])

    answers.forEach(function(answer, index){
        const answerButton = document.createElement('button')
        answerButton.setAttribute('class', 'btn btn-outline-dark')
        answerButton.innerText = answer
        answerButton.addEventListener('click', function(e){
            e.preventDefault()
            if(e.target.innerHTML === data.results[questionNumber -1].correct_answer){
                points++
                localStorage.setItem("points", points)
            }
            if(questionNumber < 20){
                location.hash = `question-${questionNumber + 1}`
            } else {
                location.hash = 'completed'
            }
            questionCard.classList.remove('animate__fadeIn')
            void questionCard.offsetWidth
            questionCard.classList.add('animate__fadeIn')
        })
        cardBody.appendChild(answerButton)
    })


    const category = document.createElement('p')
    category.innerHTML = data.results[questionNumber - 1].category
    cardFooter.appendChild(category)
}

function handleProgress(){
    let questionNumber = parseInt(location.hash.split('-')[1])

    progressText.innerText = `Completed: ${questionNumber - 1}/20`
}

function handleCompletedQuiz(){
    const score = localStorage.getItem("points")
    const correctAnswers = document.getElementById('totalCorrectAnswers')

    correctAnswers.innerText = `Total Correct Answers: ${score}/20`
}

function tryAgain(){
    location.hash = 'question-1'
    localStorage.clear()
    location.reload()
}

