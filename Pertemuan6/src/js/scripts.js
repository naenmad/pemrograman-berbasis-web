document.getElementById('gradeForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const nim = document.getElementById('nim').value;
    const grade = parseInt(document.getElementById('grade').value);
    const resultDiv = document.getElementById('result');

    let gradeLetter = '';
    let gradeMessage = '';
    let gradeClass = '';

    if (grade >= 80 && grade <= 100) {
        gradeLetter = 'A';
        gradeMessage = '🎉 Excellent! Outstanding performance!';
        gradeClass = 'grade-a';
    } else if (grade >= 70 && grade <= 79) {
        gradeLetter = 'B';
        gradeMessage = '👍 Good job! Well done!';
        gradeClass = 'grade-b';
    } else if (grade >= 60 && grade <= 69) {
        gradeLetter = 'C';
        gradeMessage = '👌 Fair performance. Keep improving!';
        gradeClass = 'grade-c';
    } else if (grade >= 50 && grade <= 59) {
        gradeLetter = 'D';
        gradeMessage = '⚠️ Below average. Need more effort!';
        gradeClass = 'grade-d';
    } else if (grade >= 0 && grade <= 49) {
        gradeLetter = 'F';
        gradeMessage = '❌ Failed. Study harder next time!';
        gradeClass = 'grade-f';
    } else {
        gradeLetter = 'Invalid';
        gradeMessage = '⚠️ Please enter a valid grade (0-100)';
        gradeClass = 'grade-f';
    }

    // Clear previous classes
    resultDiv.className = '';

    // Add animation and styling
    resultDiv.innerHTML = `
        <div style="margin-bottom: 15px;">
            <strong>NPM:</strong> ${nim}
        </div>
        <div style="font-size: 2rem; margin: 15px 0;">
            <strong>Grade: ${gradeLetter}</strong>
        </div>
        <div style="font-size: 1rem; font-weight: normal;">
            ${gradeMessage}
        </div>
    `;

    resultDiv.classList.add(gradeClass, 'show');
});