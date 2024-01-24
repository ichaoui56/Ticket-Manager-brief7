
// index page 



const tickets = document.querySelector(".tickets");
const addBtn = document.querySelectorAll(".js-add");
const ticketForm = document.querySelectorAll(".add-ticket");
const dashboard = document.querySelector(".dashboard");
// const Profile = document.querySelector(".Profile");
// const ProfileBtn = document.querySelector(".ProfileBtn");
const Mytickets = document.querySelector(".Mytickets");
const TicketBtn = document.querySelector(".TicketBtn");

addBtn.forEach(add => {
    add.addEventListener("click", () => {
        tickets.classList.add("hidden");
        // Profile.classList.add("hidden");
        ticketForm.forEach(ticket => {
            ticket.classList.remove("hidden");
        })
        Mytickets.classList.add("hidden");
    });
});

dashboard.addEventListener("click", () => {
    tickets.classList.remove("hidden");
    // Profile.classList.add("hidden");
    Mytickets.classList.add("hidden");
    ticketForm.forEach(ticket => {
        ticket.classList.add("hidden");
    })

});

// // ProfileBtn.addEventListener("click", () => {
//     tickets.classList.add("hidden");
//     // Profile.classList.remove("hidden");
//     Mytickets.classList.add("hidden");
//     ticketForm.forEach(ticket => {
//         ticket.classList.add("hidden");
//     })
// });

TicketBtn.addEventListener("click", () => {
    tickets.classList.add("hidden");
    // Profile.classList.add("hidden");
    Mytickets.classList.remove("hidden");
    ticketForm.forEach(ticket => {
        ticket.classList.add("hidden");
    })

});



