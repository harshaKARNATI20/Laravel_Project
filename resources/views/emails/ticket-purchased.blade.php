<h2>Thank you for purchasing the ticket!</h2>
<p><strong>Name of the Event:</strong> {{ $ticket->summary }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>
<p><strong>Venue:</strong> {{ $ticket->venue }}</p>
<p><strong>Start Time:</strong> {{ $ticket->start_time }}</p>
<p><strong>End Time:</strong> {{ $ticket->end_time }}</p>
<p><strong>Price per Ticket:</strong> ${{ number_format($ticket->price, 2) }}</p>
<p><strong>Number of Tickets:</strong> {{ $purchase->quantity }}</p>
<p><strong>Total Price:</strong> ${{ number_format($ticket->price * $purchase->quantity, 2) }}</p>
<p>We hope you enjoy the event!</p>
