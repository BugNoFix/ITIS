## Menu

*  [Assembly](#assembly)
	* [IF](#if)
	* [Carry](#carry)
	* [Orario](#orario)
	* [Vettori](#vettori)
*  [Esercizi](#esercizi)

# Assembly

## Teoria base
`div` => divide per tutto `ax` il resto va in `ah` il quozient in `al`

`mul` => moltiplica per `al` risultato in `ax` (prima di farlo inserire 00 in `ah`)

## Inizio

```assembly
mov ax, @data
mov ds, ax
```

## Fine

```assembly
mov ah, 04ch
int 21h
end
```

## Stampare mess

```assembly
mess db 13,10,(""),'$'
lea dx, mess
mov ah, 09h
int 21h
```

## Acquisire numero ad una cifra

Il numero si trova in `AL` sotto forma di numero reale

```assembly
mov ah, 01h
int 21h
sub al, 48d
```

## Stampare Numero ad una cifra

```assembly
mov dl, num
add dl, 48d
mov ah, 02h
int 21h
```

## Stampare numero a 2 cifre

```assembly
;pre-stampa var
  mov al, var
  mov ah, 00d
  mov bl, 10d
  div bl
  mov r, ah
  mov q, al
  add r, 48d
  add q, 48d

;stampa
  mov dl, q
  mov ah, 02h
  int 21h
  mov dl, r
  mov ah, 02h
  int 21h
```

## Sconto

```assembly
;calcolo sconto
  mov al, costo
  mov bl, 15d ;Percentuale di sconto
  mul bl
  mov bl, 100d ; non mettere 0 in ah perché contiene una parte del numero costo x15
  div bl
  sub costo, al ; sottraggo il 15% di sconto al prezzo
```

## IF

Non si può comparare un variabile con un altra variabile

```assembly
  JG >
  Jl <
  JE =
  JLE <=
  JGE >=
  JNE !=
  cmp var, num ||  cmp reg, num  ||  cmp var, reg 

;esempio
  cmp var, 02d
  je salta
  inc boh
  jmp fine ; se non si metti il jmp il programma eseguirà anche le operazione sotto

  salta:
  inc ciao

  fine:
  mov ah, 04ch
  int 21h
  end
```
*  [Menu](#Menu)

## Ciclo

Come contatore si usa `cl` e bisogna inizializzare a 0

```assembly
;ciclo while
  mov cl, 00d
  
  ciclo: ;da qua parte il ciclo
  cmp var, 02d
  je salta
  inc Se_é_uguale
  jmp ciclo ; in questo modo il ciclo si ripete e il programma non legge il codice scritto sotto
  salta:
```

## Carry

### Salto (Jump)

`JC` se c'è 1 nel carry, `JNC` se c'è 0

```asm
mov var, 11111111b
rcr var, 02d

jc salta ; se c'è 1
jmp fine

salta:

fine:
```

### Settare

`STC` mette 1 nel carry, `CLC` mette 0 nel carry

## Orario

```asm
mov ah, 2ch
int 21h

CH      Ora (0 - 23)
CL      Minuti (0 - 59)
DH      Secondi (0 - 59)
DL      Millesimi di secondi (0 - 99)
```

# Moltiplicazione

`mul p` -> p x AL risultato in ax

# Divisione

`div bl` -> ax : bl, resto in `AH` e quoziente in `AL`
*  [Menu](#Menu)

# Vettori
L'indirizzo può stare solamente in bx e per raggiungere le altre celle del vettore si usano i registri `di`, `si` (sono a 16 bit), facendo così:

```asm
lea bx, vett
```

## Creazione

```asm
.286
.data
v db 10d dup (?)
```
## Push Offset

```asm
push offset vet => lea bx, vet   push bx 
```
## Inserire qualcosa all’interno del vettore

```asm
mov [bx + di], dl <= (qualsiasi cosa, dl)
```
*  [Menu](#Menu)

## Procedura (Sotto Programma)

### Inserire variabili nella pila

`push {reg}`
Il registro può essere solamente a 16 bit

### Prendere le variabili dalla pila

`pop {reg}`
Il registro può essere solamente a 16 bit
L’indirizzo di ritorno deve essere sempre in cima alla pila quindi se dobbiamo inserire un valore nella pila l’indirizzo sarà l’ultimo valore da inserire

Si richiama il sottoprogramma nel main

`call {nome}`
**CALL**: Sospende il programma in corso, salva sulla pila l’indirizzo della successiva istruzione che dovrà eseguire la CPU al termine della routine di servizio. instruction point (IP) prende l'indirizzo della prima istruzione della routine di servizio.

**RET**: sta per ‘ritorno al programma chiamante’ prende il contenuto che si trova in cima a pila (ind di ritorno) e lo mette nel IP.

**PILA**: La pila è una delle strutture dati piu importanti ed è costituita da un insieme di celle consecutive su cui è possibile effettuae operazioni di inserimento e cancellazione, queste operazioni vengono effettuate solo dalla cime della pila 
Alla fine del main si scrive `mov ah, 04ch \n int 21h`

```asm
{Nome} proc

{Istruzioni}

ret
endp
```

*  [Menu](#Menu)

# Esercizi

## Numero compreso tra x e y

```asm
; Controllo se n e' 0
cmp n, 00d
je fine

; Controllo se n > 19
cmp n, 19d
jl viteNonBuona

; Controllo se n < 21
cmp n, 21d
jg viteNonBuona

; E' un numero tra 19 e 21 (compresi)
inc viteBuone
jmp ciclo
```

## Contare quanti bit 1 ci sono

```asm
mov cl, 00d

ciclo:
cmp cl, 08d
je fine
ror var, 01d; metto il primo bit nel curry
jnc carry1;salto se nell cartry c'e 0
inc cont

carry1:
inc cl
jmp ciclo

fine:
mov dl, cont
add dl, 48d
mov ah, 02h
int 21h
``` 

 ## Se il 3° bit è 0 scrivere un mess, se è 1 settarlo a 0 e scrive mess1

```asm
clc ;setto il curry a 0

rcr var, 03d
jc curry1 ;salta se nel curry c'è 1

lea dx, mess
mov ah, 09h
int 21h
jmp fine

curry1:
clc ;setto il curry a 0
lea dx, mess1
mov ah, 09h
int 21h

fine:
rcl var, 03d
```
## Trasformare le lettere da maiuscole a minuscole
```asm
;stampa mess
lea dx, mess
mov ah, 09h
int 21h

mov ah, 01h
int 21h
mov let, al

add let, 32d

lea dx, mess1
mov ah, 09h
int 21h

mov dl, let
mov ah, 02h
int 21h
```
## Ordinamento vettore
```asm

lea bx, v
mov di, 00d
mov si, 00d

ciclo2:
cmp di, 09d
je esci

mov si, di
ciclo3:
cmp si, 10d
je fine2

mov dl, [bx + si];temp perche altriemnti da errore nel cmp
cmp [bx + di],dl
jl fine3	;se il num è maggiore
mov al, [bx + di]
mov [bx+ di], dl
mov [bx+ si], al

fine3:
inc si
jmp ciclo3

fine2:
inc di
jmp ciclo2

esci:
```

## cancellare dal V1 tutti gli elementi del secondo vettore, per ogni elemento cancellato sostituire con *
```asm
cancellav proc
mov di, 00d

ciclo2:
cmp di, 04d
je fine2

    lea bx, v2
    mov cl, [bx + di]

    mov si, 00d

    ciclo3:
    cmp si, 10d
    je fine3

        lea bx, v1

        cmp cl, [bx + si]
        je uguali

        inc si
        jmp ciclo3

        uguali:
        ; Fix problema che dopo * c'è uno 0
        mov al, '*'
        sub al, 48d

        mov [bx + si], al
        inc si
        jmp ciclo3

    fine3:
    inc di
    jmp ciclo2

fine2:
ret
endp
```

*  [Menu](#Menu)
