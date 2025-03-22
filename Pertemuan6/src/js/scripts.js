document.getElementById('gradeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nim = document.getElementById('nim').value;
    const grade = parseInt(document.getElementById('grade').value);
    let gradeLetter = '';

    if (grade >= 80 && grade <= 100) {
        gradeLetter = 'A';
    } else if (grade >= 70 && grade <= 79) {
        gradeLetter = 'B';
    } else if (grade >= 60 && grade <= 69) {
        gradeLetter = 'C';
    } else if (grade >= 50 && grade <= 59) {
        gradeLetter = 'D';
    } else if (grade >= 0 && grade <= 49) {
        gradeLetter = 'E';
    } else {
        gradeLetter = 'Invalid grade';
    }

    document.getElementById('result').innerText = `NIM: ${nim}, Grade: ${gradeLetter}`;
});