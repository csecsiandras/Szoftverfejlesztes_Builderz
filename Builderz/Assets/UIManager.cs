using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class UIManager : MonoBehaviour {

    public RectTransform colorMenu;
    public RectTransform actionMenu;

    private bool menuAnimating;
    private bool areMenusShowing;
    private float menuAndimationTransition;

    private void Update()
    {
        if (Input.GetKeyDown(KeyCode.A))
            OnTheOneButtonClick();

        if(menuAnimating)
        {
            if (areMenusShowing)
            {
                menuAndimationTransition += Time.deltaTime;
                if (menuAndimationTransition >= 1)
                {
                    menuAndimationTransition = 1;
                    menuAnimating = false;
                }
            }
            else
            {
                menuAndimationTransition -= Time.deltaTime;
                if (menuAndimationTransition <= 0)
                {
                    menuAndimationTransition = 0;
                    menuAnimating = false;
                }
            }

            colorMenu.anchoredPosition = Vector2.Lerp(new Vector2(0, 625), new Vector2(0, -125), menuAndimationTransition);
        }   
    }

    public void OnTheOneButtonClick()
    {
        areMenusShowing = !areMenusShowing;
        PlayMenuAnimation();
     
    }

    private void PlayMenuAnimation()
    {
        menuAnimating = true;
    }
}
